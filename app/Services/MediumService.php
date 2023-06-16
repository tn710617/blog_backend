<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Http;

class MediumService
{

    const BASE_URL = 'https://api.medium.com';
    const VERSION = 'v1';

    private string $publicationId;
    private string $token;

    private string $urlWithVersion;

    public function __construct()
    {
        $this->token = config('custom.medium_token');
        $this->publicationId = config('custom.medium_publication_id');
        $this->urlWithVersion = sprintf('%s/%s', self::BASE_URL, self::VERSION);
    }

    public function postUnderPublication(array $rawData, Post $post): void
    {
        if (!$rawData['should_publish_medium'] || !app()->isProduction()) {
            return;
        }

        $url = sprintf('%s/%s/%s/%s', $this->urlWithVersion, 'publications', $this->publicationId, 'posts');

        Http::withToken($this->token)->asJson()->post($url, $this->prepareData($rawData, $post))->throw();
    }

    private function prepareData(array $rawData, Post $post): array
    {
        return [
            'title' => $rawData['post_title'],
            'contentFormat' => 'markdown',
            'content' => $rawData['post_content'],
            'tags' => $post->tags->pluck('tag_name')->toArray(),
            'publishStatus' => 'draft',
            'canonicalUrl' => $this->getCanonicalUrl($post)
        ];
    }

    private function getCanonicalUrl(Post $post): string
    {
        return sprintf('%s/%s?%s=%s', config('custom.frontend_url'), 'single-post', 'post_id', $post->id);
    }
}