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

    protected array $excludedColumns = [
        'used_at', 'used_count'
    ];
    protected string $model = Tag::class;
    protected array $uniqueKey = ['id'];
    protected bool $timestamps = false;
    protected array $cacheKeys = [];
    protected array $definedData;


    public function setDefinedData(): void
    {
        $this->definedData = [
            [
                'id' => 1,
                'tag_name' => 'Laravel',
                'is_private' => false,
                'used_count' => 0,
            ],
            [
                'id' => 2,
                'tag_name' => 'Backend',
                'is_private' => false,
                'used_count' => 0,
            ],
            [
                'id' => 3,
                'tag_name' => 'Frontend',
                'is_private' => false,
                'used_count' => 0,
            ],
            [
                'id' => 4,
                'tag_name' => 'DevOps',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 5,
                'tag_name' => 'Node.js',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 6,
                'tag_name' => 'React',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 7,
                'tag_name' => 'HTML',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 8,
                'tag_name' => 'CSS',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 9,
                'tag_name' => 'Tailwind CSS',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 10,
                'tag_name' => 'PHP',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 11,
                'tag_name' => 'MySQL',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 12,
                'tag_name' => 'CSV',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 13,
                'tag_name' => 'Git',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 14,
                'tag_name' => 'Apache',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 15,
                'tag_name' => 'Blockchain',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 16,
                'tag_name' => 'GitLab Runner',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 17,
                'tag_name' => 'CI/CD',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 18,
                'tag_name' => 'Payment Gateway',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 19,
                'tag_name' => 'Facebook',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 20,
                'tag_name' => 'Google Analytics',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 21,
                'tag_name' => 'AWS',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 22,
                'tag_name' => 'Infrastructure',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 23,
                'tag_name' => 'Jenkins',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 24,
                'tag_name' => 'GitHub',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 25,
                'tag_name' => 'Kubernetes',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 26,
                'tag_name' => 'GCP GKE',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 27,
                'tag_name' => 'Geth',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 28,
                'tag_name' => 'Prysm',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 29,
                'tag_name' => 'Blockchain Node',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 30,
                'tag_name' => 'GCP',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 31,
                'tag_name' => 'GCP Stackdriver',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 32,
                'tag_name' => 'GCP Compute Engine',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 33,
                'tag_name' => 'GCP Marketplace',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 34,
                'tag_name' => 'Hexo',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 35,
                'tag_name' => 'PayPal',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 36,
                'tag_name' => 'Event Bubbling',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 37,
                'tag_name' => 'React Effect',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 38,
                'tag_name' => 'React State',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 39,
                'tag_name' => 'Apache Bench',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 40,
                'tag_name' => 'High Concurrency',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 41,
                'tag_name' => 'Deployment',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 42,
                'tag_name' => 'Jmeter',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 43,
                'tag_name' => 'gopass',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 44,
                'tag_name' => 'Docker',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 45,
                'tag_name' => 'Docker Swarm',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 46,
                'tag_name' => 'SSH',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 47,
                'tag_name' => 'Supervisor',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 48,
                'tag_name' => 'LeetCode',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 49,
                'tag_name' => 'Algorithm',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 50,
                'tag_name' => 'Algorithm - Array',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 51,
                'tag_name' => 'Algorithm - Two Pointers',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 52,
                'tag_name' => 'GCP Persistence Disk',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 53,
                'tag_name' => 'Shadowsocks',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 54,
                'tag_name' => 'Expressjs',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 55,
                'tag_name' => 'GoDaddy',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 56,
                'tag_name' => 'MetaMask',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 57,
                'tag_name' => 'PHP-FPM',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 58,
                'tag_name' => 'Algorithm - Hash Table',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 59,
                'tag_name' => 'Markdown',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 60,
                'tag_name' => 'jq',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 61,
                'tag_name' => 'command line',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 62,
                'tag_name' => 'CKEditor',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 63,
                'tag_name' => 'Algorithm - Linked List',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 64,
                'tag_name' => 'Algorithm - Traverse',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 65,
                'tag_name' => 'GCP Cloud Shell',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 66,
                'tag_name' => 'GCP Gcloud',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 67,
                'tag_name' => 'Data Structure',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 68,
                'tag_name' => 'Google',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 69,
                'tag_name' => 'Apple',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 70,
                'tag_name' => 'Single Sign-On',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 71,
                'tag_name' => 'K6',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 72,
                'tag_name' => 'PHPSTORM',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 73,
                'tag_name' => 'Laravel Socialite',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 74,
                'tag_name' => 'Laravel Carbon',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 75,
                'tag_name' => 'GCP Load Balancer',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 76,
                'tag_name' => 'Ethereum',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 77,
                'tag_name' => 'GCP Cloud Logging',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 78,
                'tag_name' => 'Surasia',
                'is_private' => true,
                'used_count' => 0
            ],
            [
                'id' => 79,
                'tag_name' => 'FortVax',
                'is_private' => true,
                'used_count' => 0
            ],
            [
                'id' => 80,
                'tag_name' => 'GCP Ops Agent',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 81,
                'tag_name' => 'AWS SQS',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 82,
                'tag_name' => 'React Strict Mode',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 83,
                'tag_name' => 'OOP',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 84,
                'tag_name' => 'Nginx',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 85,
                'tag_name' => 'WebDAV',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 86,
                'tag_name' => 'SFTP',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 87,
                'tag_name' => 'FTP',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 88,
                'tag_name' => 'AWS SES',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 89,
                'tag_name' => 'PM2',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 90,
                'tag_name' => 'Travelling',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 91,
                'tag_name' => 'React Hook',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 92,
                'tag_name' => 'GCP GKE',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 92,
                'tag_name' => 'React Render',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 93,
                'tag_name' => 'GCP IAM',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 94,
                'tag_name' => 'Laravel Blade',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 95,
                'tag_name' => 'React Memo',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 96,
                'tag_name' => 'Anki',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 97,
                'tag_name' => 'Linux',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 98,
                'tag_name' => 'MongoDB',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 99,
                'tag_name' => 'React useMemo',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 100,
                'tag_name' => 'React useCallback',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 101,
                'tag_name' => 'NFS',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 102,
                'tag_name' => 'GCP Cloud Function',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 103,
                'tag_name' => 'GCP Cloud Storage',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 104,
                'tag_name' => 'Spinnaker',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 105,
                'tag_name' => 'Algorithm - Binary Search',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 106,
                'tag_name' => 'MySQL Redo Log',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 107,
                'tag_name' => 'MySQL Binlog',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 108,
                'tag_name' => 'Algorithm - Binary Tree',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 109,
                'tag_name' => 'Algorithm - Stack',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 110,
                'tag_name' => 'Algorithm - Sliding Window',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 111,
                'tag_name' => 'WordPress',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 112,
                'tag_name' => 'Woocommerce',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 113,
                'tag_name' => 'DB Isolation Level',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 114,
                'tag_name' => 'Data Structure - Tree',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 115,
                'tag_name' => 'Data Structure - Binary Search Tree',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 116,
                'tag_name' => 'Data Structure - Binary Tree',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 117,
                'tag_name' => 'Recursion',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 118,
                'tag_name' => 'GCP Pub/Sub',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 119,
                'tag_name' => 'HTTP',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 120,
                'tag_name' => 'InfluxDB',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 121,
                'tag_name' => 'GCP Deployment Manager',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 122,
                'tag_name' => 'Laradock',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 123,
                'tag_name' => 'Let\'s Encrypt',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 124,
                'tag_name' => 'Redis',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 125,
                'tag_name' => 'GCP VPC',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 126,
                'tag_name' => 'Netdata',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 127,
                'tag_name' => 'OS',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 128,
                'tag_name' => 'Algorithm - Bubble Sort',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 129,
                'tag_name' => 'Sequelize',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 130,
                'tag_name' => 'Lua',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 131,
                'tag_name' => 'GCP BigQuery',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 132,
                'tag_name' => 'Composer',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 133,
                'tag_name' => 'Networking',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 134,
                'tag_name' => 'Pokemon Go',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 135,
                'tag_name' => 'CFW',
                'is_private' => true,
                'used_count' => 0
            ],
            [
                'id' => 136,
                'tag_name' => 'Index',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 137,
                'tag_name' => 'WireGuard',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 138,
                'tag_name' => 'Laravel Reverb',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 139,
                'tag_name' => 'Laravel Scramble',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 140,
                'tag_name' => 'API Documentation',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 141,
                'tag_name' => 'Portfolio',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 142,
                'tag_name' => 'Service Worker',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 143,
                'tag_name' => 'Web Notification',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 144,
                'tag_name' => 'TNP',
                'is_private' => true,
                'used_count' => 0
            ],
            [
                'id' => 145,
                'tag_name' => 'Diary',
                'is_private' => true,
                'used_count' => 0
            ],
            [
                'id' => 146,
                'tag_name' => 'GCP Security Policy',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 147,
                'tag_name' => 'GitLab',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 148,
                'tag_name' => 'Firebase',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 149,
                'tag_name' => 'FCM',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 150,
                'tag_name' => 'Design Pattern',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 151,
                'tag_name' => 'Next.js',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 152,
                'tag_name' => 'Slack',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 153,
                'tag_name' => 'Logging',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 154,
                'tag_name' => 'VAPT',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 155,
                'tag_name' => 'GCP Uptime Check',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 156,
                'tag_name' => 'Health Check',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 157,
                'tag_name' => 'TypeScript',
                'is_private' => false,
                'used_count' => 0
            ],
            [
                'id' => 158,
                'tag_name' => 'Reading',
                'is_private' => false,
                'used_count' => 0
            ],
        ];
    }

}
