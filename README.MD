This application provides useful and convenient way to show statistics of GutHub user or user's repositories. What's more, it provides simple way to compare two repositories.

## To boot up an application using local environment:
1) Run "composer install" command/
2) Run "php artisan serve" command or run up you local server/
3) Optionally, run test from /tests/Unit/ catalog/
4) Head to the 127.0.0.1:8000 website or website configured by your local server.

## Application has 4 abilities:

### List user statistics
`/api/repository/list/{gitHubUsername} (GET)`

### Show repository details
`/api/repository/stats/{gitHubUsername}/{repositoryName} (GET)` 

### Compare two repositories
`/api/repository/compare/{firstUsername}:{firstRepositoryName}/{secondUsername}:{secondRepositoryName} (GET)`

### Show user details
`/api/user/info/{gitHubUsername}/{repositoryName} (GET)`

Working server-side API: http://schibsted.piwolucja.pl/

### !!! Please note that GitHub API allows only to make 60 requests. Comparison uses 6 requests! 