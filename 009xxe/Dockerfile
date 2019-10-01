FROM ubuntu:trusty

MAINTAINER Gabe Marshall <gabemarshall@me.com>

RUN apt-get -yqq --force-yes update
RUN apt-get -yqq --force-yes install openjdk-6-jdk 
RUN apt-get -yqq --force-yes install maven gopher

COPY ./ ./
RUN echo 'FLAG{Xuman_Like_Machines}' >> /etc/passwd

CMD ["mvn", "jetty:run"]
