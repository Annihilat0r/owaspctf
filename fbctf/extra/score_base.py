# -------------------------------------------------------------
# BASE: Simple script to score points for the facebook CTF
# -------------------------------------------------------------
#
# Written by Javier (@javutin)

import time
import json
import hashlib
import logging
from BaseHTTPServer import HTTPServer, BaseHTTPRequestHandler

HOST = ''
PORT = 12345
INFINITE_LOOP = 1
TEAM_FILE = "/tmp/SCORE_POINTS"
TEAM_NAME = "team"
TEAM_MD5 = "check"
LOG_FILE = "score_http.log"
LOG = 1
DEFAULT_VALUE = "facebookCTF"
CHAR_LIMIT = 32
LINES_LIMIT = 1

if LOG == 1:
  logger = logging.getLogger(__name__)
  logfile = logging.FileHandler(LOG_FILE)
  formatter = logging.Formatter('[ %(asctime)s ] - %(message)s')
  logfile.setFormatter(formatter)
  logger.addHandler(logfile)
  logger.setLevel(logging.INFO)

class customHTTPServer(BaseHTTPRequestHandler):
  def log_request(self, code): pass
  def do_GET(self):
    list_teams = []
    json_list = []
    try:
      if LOG == 1:
        logger.info('%s %s' % (self.client_address, self.command))
      else:
        print "[ %s ] %s %s" % (time.asctime(), self.client_address, self.command)
      self.send_response(200)
      self.end_headers()
      f = open(TEAM_FILE, 'r')
      teams = f.readlines()[:LINES_LIMIT]
      for t in teams:
        list_teams.append(t.strip()[:CHAR_LIMIT])
      f.close()
    except Exception, e:
      if LOG == 1:
        logger.info('Oops! Something happened: %s' % (e.strerror))
      else:
      	print "[ %s ] Oops! Something happened: %s" % (time.asctime(), e.strerror)
      team_name = DEFAULT_VALUE
      list_teams.append(team_name)

    #list_teams = list(set(list_teams))
    for l_t in list_teams:
      team_md5 = hashlib.md5(l_t).hexdigest()
      team_list = { TEAM_NAME : l_t, TEAM_MD5 : team_md5 }
      json_list.append(team_list)
    teams_json_list = json.dumps(json_list);
    self.wfile.write(teams_json_list)
    self.wfile.write('\n')
    if LOG == 1:
      logger.info('Sent %s' % (teams_json_list))
    else:
      print "[ %s ] Sent %s" % (time.asctime(), teams_json_list)
    return

def main():
  try:
    server = HTTPServer((HOST,PORT),customHTTPServer)
    if LOG == 1:
      logger.info('CTF Scorer Starts - %s:%s' % (HOST, PORT))
    else:
      print "[ %s ] CTF Scorer Starts - %s:%s" % (time.asctime(), HOST, PORT)
    server.serve_forever()
  except KeyboardInterrupt:
    if LOG == 1:
      logger.info('CTF Scorer Stopped')
    else:
      print "[ %s ] CTF Scorer Stopped" % (time.asctime())
    server.socket.close()

if __name__=='__main__':
    main()

# EOF
