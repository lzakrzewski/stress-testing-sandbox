FROM ubuntu:16.04

RUN apt-get update && apt-get install -y \
    openssh-server \
    python \
    vim \
    --no-install-recommends && rm -r /var/lib/apt/lists/*

RUN mkdir /var/run/sshd
RUN mkdir /root/.ssh

EXPOSE 22

CMD ["/usr/sbin/sshd", "-D"]