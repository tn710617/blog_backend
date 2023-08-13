<?php

namespace Database\Seeders\V1;

use App\Models\Tag;
use App\Traits\DefaultSeederTrait;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{

    use DefaultSeederTrait;

    public function __construct()
    {
        $this->setDefinedData();
    }

    protected $excludedColumns = [
        'used_at'
    ];
    protected $model = Tag::class;
    protected $uniqueKey = ['id'];
    protected $timestamps = false;
    protected $cacheKeys = [];
    protected $definedData;


    public function setDefinedData()
    {
        $this->definedData = [
            [
                'id' => 1,
                'tag_name' => 'Laravel',
            ],
            [
                'id' => 2,
                'tag_name' => 'Backend',
            ],
            [
                'id' => 3,
                'tag_name' => 'Frontend',
            ],
            [
                'id' => 4,
                'tag_name' => 'DevOps',
            ],
            [
                'id' => 5,
                'tag_name' => 'Node.js',
            ],
            [
                'id' => 6,
                'tag_name' => 'React',
            ],
            [
                'id' => 7,
                'tag_name' => 'HTML',
            ],
            [
                'id' => 8,
                'tag_name' => 'CSS',
            ],
            [
                'id' => 9,
                'tag_name' => 'Tailwind CSS',
            ],
            [
                'id' => 10,
                'tag_name' => 'PHP',
            ],
            [
                'id' => 11,
                'tag_name' => 'MySQL',
            ],
            [
                'id' => 12,
                'tag_name' => 'CSV',
            ],
            [
                'id' => 13,
                'tag_name' => 'Git',
            ],
            [
                'id' => 14,
                'tag_name' => 'Apache',
            ],
            [
                'id' => 15,
                'tag_name' => 'Blockchain',
            ],
            [
                'id' => 16,
                'tag_name' => 'GitLab Runner',
            ],
            [
                'id' => 17,
                'tag_name' => 'CI/CD',
            ],
            [
                'id' => 18,
                'tag_name' => 'Payment Gateway',
            ],
            [
                'id' => 19,
                'tag_name' => 'Facebook',
            ],
            [
                'id' => 20,
                'tag_name' => 'Google Analytics',
            ],
            [
                'id' => 21,
                'tag_name' => 'AWS',
            ],
            [
                'id' => 22,
                'tag_name' => 'Infrastructure',
            ],
            [
                'id' => 23,
                'tag_name' => 'Jenkins',
            ],
            [
                'id' => 24,
                'tag_name' => 'GitHub',
            ],
            [
                'id' => 25,
                'tag_name' => 'Kubernetes',
            ],
            [
                'id' => 26,
                'tag_name' => 'GCP GKE',
            ],
            [
                'id' => 27,
                'tag_name' => 'Geth',
            ],
            [
                'id' => 28,
                'tag_name' => 'Prysm',
            ],
            [
                'id' => 29,
                'tag_name' => 'Blockchain Node',
            ],
            [
                'id' => 30,
                'tag_name' => 'GCP',
            ],
            [
                'id' => 31,
                'tag_name' => 'GCP Stackdriver',
            ],
            [
                'id' => 32,
                'tag_name' => 'GCP Compute Engine',
            ],
            [
                'id' => 33,
                'tag_name' => 'GCP Marketplace',
            ],
            [
                'id' => 34,
                'tag_name' => 'Hexo',
            ],
            [
                'id' => 35,
                'tag_name' => 'PayPal',
            ],
            [
                'id' => 36,
                'tag_name' => 'Event Bubbling',
            ],
            [
                'id' => 37,
                'tag_name' => 'React Effect',
            ],
            [
                'id' => 38,
                'tag_name' => 'React State',
            ],
            [
                'id' => 39,
                'tag_name' => 'Apache Bench',
            ],
            [
                'id' => 40,
                'tag_name' => 'High Concurrency',
            ],
            [
                'id' => 41,
                'tag_name' => 'Deployment',
            ],
            [
                'id' => 42,
                'tag_name' => 'Jmeter',
            ],
            [
                'id' => 43,
                'tag_name' => 'gopass',
            ],
            [
                'id' => 44,
                'tag_name' => 'Docker',
            ],
            [
                'id' => 45,
                'tag_name' => 'Docker Swarm',
            ],
            [
                'id' => 46,
                'tag_name' => 'SSH',
            ],
            [
                'id' => 47,
                'tag_name' => 'Supervisor',
            ],
            [
                'id' => 48,
                'tag_name' => 'LeetCode',
            ],
            [
                'id' => 49,
                'tag_name' => 'Algorithm',
            ],
            [
                'id' => 50,
                'tag_name' => 'Algorithm - Array',
            ],
            [
                'id' => 51,
                'tag_name' => 'Algorithm - Two Pointers',
            ],
            [
                'id' => 52,
                'tag_name' => 'GCP Persistence Disk',
            ],
            [
                'id' => 53,
                'tag_name' => 'Shadowsocks',
            ],
            [
                'id' => 54,
                'tag_name' => 'Expressjs',
            ],
            [
                'id' => 55,
                'tag_name' => 'GoDaddy',
            ],
            [
                'id' => 56,
                'tag_name' => 'MetaMask',
            ],
            [
                'id' => 57,
                'tag_name' => 'PHP-FPM',
            ],
            [
                'id' => 58,
                'tag_name' => 'Algorithm - Hash Table',
            ],
            [
                'id' => 59,
                'tag_name' => 'Markdown',
            ],
            [
                'id' => 60,
                'tag_name' => 'jq',
            ],
            [
                'id' => 61,
                'tag_name' => 'command line',
            ],
            [
                'id' => 62,
                'tag_name' => 'CKEditor',
            ],
            [
                'id' => 63,
                'tag_name' => 'Algorithm - Linked List',
            ],
            [
                'id' => 64,
                'tag_name' => 'Algorithm - Traverse',
            ],
            [
                'id' => 65,
                'tag_name' => 'GCP Cloud Shell',
            ],
            [
                'id' => 66,
                'tag_name' => 'GCP Gcloud',
            ],
            [
                'id' => 67,
                'tag_name' => 'Data Structure',
            ],
            [
                'id' => 68,
                'tag_name' => 'Google',
            ],
            [
                'id' => 69,
                'tag_name' => 'Apple',
            ],
            [
                'id' => 70,
                'tag_name' => 'Single Sign-On',
            ],
            [
                'id' => 71,
                'tag_name' => 'K6',
            ],
            [
                'id' => 72,
                'tag_name' => 'PHPSTORM',
            ],
            [
                'id' => 73,
                'tag_name' => 'Laravel Socialite',
            ],
            [
                'id' => 74,
                'tag_name' => 'Laravel Carbon',
            ],
            [
                'id' => 75,
                'tag_name' => 'GCP Load Balancer',
            ],
            [
                'id' => 76,
                'tag_name' => 'Ethereum',
            ],
            [
                'id' => 77,
                'tag_name' => 'GCP Cloud Logging',
            ],
            [
                'id' => 78,
                'tag_name' => 'Surasia',
            ],
            [
                'id' => 79,
                'tag_name' => 'FortVax',
            ],
            [
                'id' => 80,
                'tag_name' => 'GCP Ops Agent',
            ],
            [
                'id' => 81,
                'tag_name' => 'AWS SQS',
            ],
            [
                'id' => 82,
                'tag_name' => 'React Strict Mode',
            ],
            [
                'id' => 83,
                'tag_name' => 'OOP',
            ],
            [
                'id' => 84,
                'tag_name' => 'Nginx',
            ],
            [
                'id' => 85,
                'tag_name' => 'WebDAV',
            ],
            [
                'id' => 86,
                'tag_name' => 'SFTP',
            ],
            [
                'id' => 87,
                'tag_name' => 'FTP',
            ],
            [
                'id' => 88,
                'tag_name' => 'AWS SES',
            ],
            [
                'id' => 89,
                'tag_name' => 'PM2',
            ],
            [
                'id' => 90,
                'tag_name' => 'Travelling',
            ],
            [
                'id' => 91,
                'tag_name' => 'React Hook',
            ],
            [
                'id' => 92,
                'tag_name' => 'GCP GKE',
            ],
            [
                'id' => 92,
                'tag_name' => 'React Render',
            ],
            [
                'id' => 93,
                'tag_name' => 'GCP IAM',
            ],
            [
                'id' => 94,
                'tag_name' => 'Laravel Blade',
            ],
            [
                'id' => 95,
                'tag_name' => 'React Memo',
            ],
            [
                'id' => 96,
                'tag_name' => 'Anki',
            ],
            [
                'id' => 97,
                'tag_name' => 'Linux',
            ],
            [
                'id' => 98,
                'tag_name' => 'MongoDB',
            ],
            [
                'id' => 99,
                'tag_name' => 'React useMemo',
            ],
            [
                'id' => 100,
                'tag_name' => 'React useCallback',
            ],
            [
                'id' => 101,
                'tag_name' => 'NFS',
            ],
            [
                'id' => 102,
                'tag_name' => 'GCP Cloud Function',
            ],
            [
                'id' => 103,
                'tag_name' => 'GCP Cloud Storage',
            ],
            [
                'id' => 104,
                'tag_name' => 'Spinnaker',
            ],
            [
                'id' => 105,
                'tag_name' => 'Algorithm - Binary Search',
            ],
            [
                'id' => 106,
                'tag_name' => 'MySQL Redo Log',
            ],
            [
                'id' => 107,
                'tag_name' => 'MySQL Binlog',
            ],
            [
                'id' => 108,
                'tag_name' => 'Algorithm - Binary Tree',
            ],
            [
                'id' => 109,
                'tag_name' => 'Algorithm - Stack',
            ],
            [
                'id' => 110,
                'tag_name' => 'Algorithm - Sliding Window',
            ],
            [
                'id' => 111,
                'tag_name' => 'WordPress',
            ],
            [
                'id' => 112,
                'tag_name' => 'Woocommerce',
            ],
            [
                'id' => 113,
                'tag_name' => 'DB Isolation Level',
            ],
            [
                'id' => 114,
                'tag_name' => 'Data Structure - Tree',
            ],
            [
                'id' => 115,
                'tag_name' => 'Data Structure - Binary Search Tree',
            ],
            [
                'id' => 116,
                'tag_name' => 'Data Structure - Binary Tree',
            ],
            [
                'id' => 117,
                'tag_name' => 'Recursion',
            ],
        ];
    }


}
