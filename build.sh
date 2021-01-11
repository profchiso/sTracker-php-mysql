dbFileName='./smarttrackerdb.sql'

DB_DATABASE=smarttrackerdb
DB_USERNAME=root
DB_PASSWORD=chinedu

#Bring up the container
docker-compose up -d

echo "Setup DB with test data"
echo "DROP DATABASE IF EXISTS $DB_DATABASE; CREATE DATABASE $DB_DATABASE" | docker exec -i $(docker-compose ps -q db) mysql -u $DB_USERNAME -p$DB_PASSWORD $DB_DATABASE
cat $dbFileName | docker exec -i $(docker-compose ps -q db) mysql -u $DB_USERNAME -p$DB_PASSWORD $DB_DATABASE

echo "good to go"