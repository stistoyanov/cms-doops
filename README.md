# cms-doops
CMS for dev ops

Laravel instalation

    cd laravel_58

    ./insitialSetup.sh

Install Supervisor

    sudo apt-get install supervisor

Create worker

    sudo nano /etc/supervisor/conf.d/cms-doops.worker.conf
    
Paste in the following:

    [program:cms-doops-worker]
    process_name=%(program_name)s_%(process_num)02d
    command=php /var/www/html/cms-doops/laravel_58/artisan queue:work database --sleep=3 --tries=3
    autostart=true
    autorestart=true
    numprocs=8
    redirect_stderr=true
    stdout_logfile=/var/www/html/cms-doops/laravel_58/storage/cms-doops-worker.log
    
Start Supervisor

    sudo supervisorctl reread
    
    sudo supervisorctl update
    
    sudo supervisorctl start cms-doops-worker:*