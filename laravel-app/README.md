# Description
```
Develop Using Laravel then containerized it through Docker
This Application will consist of REST API, Google Log In(Socialite) and Front-End(HTML,CSS,JavaScript)
Front-End Calling Rest Api using AJAX Request.Token will store in cookies in front end for verification purpose
Database will be localhost.(Add an env file or Modify the env file based on the configuration below will do.)
```

# Env file configuration 
```
APP_URL=http://localhost
GOOGLE_CLIENT_ID=73810002661-tmror47e3antu9eeg93iktnmlofq4f20.apps.googleusercontent.com
GOOGLE_SECRET_ID=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
GOOGLE_REDIRECT=http://localhost:9000/auth/google/callback 

DB_CONNECTION=mysql
DB_HOST=mysql_db
DB_PORT=3306
DB_DATABASE=laravel_docker
DB_USERNAME=root
DB_PASSWORD=root
```
# Requirement 
```
WINDOW (DOCKER DESKTOP,WSL2,Laravel) 
UBUNTU(DOCKER,Laravel)
```
# Instruction Docker Desktop + WSL2 Ubuntu Window 11.
```
- pull the code to WSL2 Ubuntu directory if no it will have latency issue due to layer between window directory and linux directory 
- docker pull jecksondian/assestment:v2.0.
- run the docker using make run or docker compose up.
- go the terminal through docker desktop and run php artisan migrate.
```
# Instruction Docker with Ubuntu.
```
- pull the code into Ubuntu directory .
- docker pull jecksondian/assestment:v2.0.
- run the docker using make run or docker compose up.
- run php artisan migrate.
```

# Simple UI Interface Instruction 
```
LOGIN PAGE : Click Login (Google Sign In UI will pop out) if no just refresh the page will do 
DASHBOARD PAGE :
Email and Name show.
Log Out Button, Add New To-Do List,Delete TO-DO List, Update complete status of TO-DO List.
```
