# Results

I made a few tries to compare multiple infrastructure setup:

## 1 x 1-CPU, 2GB RAM, Ubuntu 16.04 [Digitalocean](https://www.digitalocean.com/) droplet

![](results/req-per-sec/1x-1-CPU-2GB-16.04-50-50.png)

| From [RPS] | to [RPS] |
|:-----------|:---------|
| 1          | 50       |

It can handle ~ **14** requests per second.
**See [result](https://htmlpreview.github.io/?https://github.com/lzakrzewski/stress-testing-sandbox/blob/master/doc/results/html/1x-1-CPU-2GB-16.04-50-50/index.html).**

## 2 x 1-CPU, 2GB RAM, Ubuntu 16.04 [Digitalocean](https://www.digitalocean.com/) droplet

![](results/req-per-sec/2x-1-CPU-2GB-16.04-50-50.png)

| From [RPS] | to [RPS] |
|:-----------|:---------|
| 1          | 50       |

It can handle ~ **36** requests per second.
**See [result](https://htmlpreview.github.io/?https://github.com/lzakrzewski/stress-testing-sandbox/blob/master/doc/results/html/2x-1-CPU-2GB-16.04-50-50/index.html).**

## 1 x 2-CPU, 4GB RAM, Ubuntu 16.04 [Digitalocean](https://www.digitalocean.com/) droplet

![](results/req-per-sec/1x-2-CPU-4GB-16.04-100-100.png)

| From [RPS] | to [RPS] |
|:-----------|:---------|
| 1          | 100      |

It can handle ~ **50** requests per second.
**See [result](https://htmlpreview.github.io/?https://github.com/lzakrzewski/stress-testing-sandbox/blob/master/doc/results/html/1x-2-CPU-4GB-16.04-100-100/index.html).**

## 2 x 2-CPU, 4GB RAM, Ubuntu 16.04 [Digitalocean](https://www.digitalocean.com/) droplet

![](results/req-per-sec/2x-2-CPU-4GB-16.04-100-100.png)

| From [RPS] | to [RPS] |
|:-----------|:---------|
| 1          | 100      |

It can handle ~ **70** requests per second.
**See [result](https://htmlpreview.github.io/?https://github.com/lzakrzewski/stress-testing-sandbox/blob/master/doc/results/html/2x-2-CPU-4GB-16.04-100-100/index.html).**

## 1 x 8-CPU, 16GB RAM, Ubuntu 16.04 [Digitalocean](https://www.digitalocean.com/) droplet

![](results/req-per-sec/1x-8-CPU-16GB-16.04-200-200.png)

| From [RPS] | to [RPS] |
|:-----------|:---------|
| 1          | 200      |

It can handle ~ **180** requests per second.
**See [result](https://htmlpreview.github.io/?https://github.com/lzakrzewski/stress-testing-sandbox/blob/master/doc/results/html/1x-8-CPU-16GB-16.04-200-200/index.html).**

## 2 x 8-CPU, 16GB RAM, Ubuntu 16.04 [Digitalocean](https://www.digitalocean.com/) droplet

![](results/req-per-sec/2x-8-CPU-16GB-16.04-200-200.png)

| From [RPS] | to [RPS] |
|:-----------|:---------|
| 1          | 200      |

It can handle ~ **180** requests per second.
**See [result](https://htmlpreview.github.io/?https://github.com/lzakrzewski/stress-testing-sandbox/blob/master/doc/results/html/2x-8-CPU-16GB-16.04-200-200/index.html).**