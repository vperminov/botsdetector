#Bots detector plugin for October CMS
###Register bots visits on your site and make report

Just fill *settings* and add *Bots detector* component to the layout. 

Add a cronjob on your server 
```
* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1
```

That's all. You will receive a report on email