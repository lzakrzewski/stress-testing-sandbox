FROM ubuntu:16.04

RUN apt-get update && apt-get install -y \
    openssh-server \
    python \
    vim \
    --no-install-recommends && rm -r /var/lib/apt/lists/*

RUN mkdir /var/run/sshd
RUN mkdir /root/.ssh

ARG PHP_APPLICATION_SSH_KEY_RAW

RUN echo $PHP_APPLICATION_SSH_KEY_RAW >> /root/.ssh/authorized_keys

EXPOSE 22

CMD ["/usr/sbin/sshd", "-D"]