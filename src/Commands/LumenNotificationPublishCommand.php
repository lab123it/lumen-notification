<?php

namespace LumenNotification\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class LumenNotificationPublishCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'lumen-notification:publish
                            {--force : Overwrite any existing files}
                            {--provider= : The service provider that has assets you want to publish}
                            {--tag= : The tag that has assets you want to publish}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish any publishable assets from lumen-notification package';

    public function __construct(protected Filesystem $files)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $paths = ServiceProvider::pathsToPublish($this->option('provider'), $this->option('tag'));

        if (empty($paths)) {
            $this->comment('Nothing to publish.');

            return;
        }

        foreach ($paths as $from => $to) {
            if ($this->files->isFile($from)) {
                $this->publishFile($from, $to);
            } elseif ($this->files->isDirectory($from)) {
                $this->publishDirectory($from, $to);
            } else {
                $this->error("Can't locate path: <{$from}>");
            }
        }

        $this->info('Publishing Complete!');
    }

    protected function publishFile(string $from, string $to): void
    {
        if ($this->files->exists($to) && ! $this->option('force')) {
            return;
        }

        $this->createParentDirectory(dirname($to));
        $this->files->copy($from, $to);
        $this->status($from, $to, 'File');
    }

    protected function publishDirectory(string $from, string $to): void
    {
        $this->files->copyDirectory($from, $to);
        $this->status($from, $to, 'Directory');
    }

    protected function createParentDirectory(string $directory): void
    {
        if (! $this->files->isDirectory($directory)) {
            $this->files->makeDirectory($directory, 0755, true);
        }
    }

    protected function status(string $from, string $to, string $type): void
    {
        $base = $this->laravel->basePath();
        $from = str_replace($base, '', (string) realpath($from));
        $to = str_replace($base, '', (string) realpath($to));

        $this->line('<info>Copied ' . $type . '</info> <comment>[' . $from . ']</comment> <info>To</info> <comment>[' . $to . ']</comment>');
    }
}
