# 😀 Patrik Laszlo's Resume Web

[![Build Status](https://github.com/patrikx3/resume-web/workflows/build/badge.svg)](https://github.com/patrikx3/resume-web/actions?query=workflow%3Abuild) [![Docker](https://img.shields.io/badge/Docker-alive-blue.svg)](https://hub.docker.com/r/patrikx3/resume/) [![CodeSHip](https://codeship.com/projects/951b4e20-b118-0134-b8d2-02806e5946e9/status?branch=master)

http://www.patrikx3.com

# Docker
[Check out how to run it](https://hub.docker.com/r/patrikx3/resume/)

```bash
docker pull patrikx3/resume
docker run -h docker-patrikx3-resume -p 8080:8080 -t -i patrikx3/resume
```

http://localhost:8080/



## E-mail
File: deployment/settings.json
```bash
{
  "debug": true,
  "recaptcha": {
    "frontend": "",
    "backend": ""
  },
  "google": {
    "maps": ""
  },
  "email": {
    "smtp": {
      "host": "smtp.gmail.com",
      "port": 465,
      "security": "ssl"
    },
    "username": "skeleton@gmail.com",
    "password": "secure"
  }
}

```



http://patrikx3.com

http://github.com/patrikx3/resume
