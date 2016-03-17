--- 
customlog: 
  - 
    format: combined
    target: /usr/local/apache/domlogs/30sa-dev.com
  - 
    format: "\"%{%s}t %I .\\n%{%s}t %O .\""
    target: /usr/local/apache/domlogs/30sa-dev.com-bytes_log
documentroot: /home/n0sade5/public_html
group: n0sade5
hascgi: 1
homedir: /home/n0sade5
ifmoduleitkc: {}

ifmodulemodincludec: 
  directoryhomensadepublichtml: 
    ssilegacyexprparser: 
      - 
        value: " On"
ifmodulemodsuphpc: 
  group: n0sade5
include: 
  - 
    include: "\"/usr/local/apache/conf/userdata/std/2/n0sade5/*.conf\""
ip: 198.46.81.204
owner: inmotion
phpopenbasedirprotect: 1
port: 80
scriptalias: 
  - 
    path: /home/n0sade5/public_html/cgi-bin
    url: /cgi-bin/
  - 
    path: /home/n0sade5/public_html/cgi-bin/
    url: /cgi-bin/
serveradmin: webmaster@30sa-dev.com
serveralias: www.30sa-dev.com
servername: 30sa-dev.com
usecanonicalname: 'Off'
user: n0sade5
userdirprotect: ''
