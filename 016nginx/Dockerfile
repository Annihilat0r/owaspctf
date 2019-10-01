FROM vulhub/nginx:1
run apt-get update && apt-get install nano -y
COPY ./configuration/ /etc/nginx/conf.d
COPY ./files/ /home/
COPY ./src/ /usr/share/nginx/html/
