#!/usr/bin/env python

from BaseHTTPServer import BaseHTTPRequestHandler, HTTPServer
import SocketServer
import cgi
import urlparse

global tmp_file
tmp_file = ""

class S(BaseHTTPRequestHandler):
    def _set_headers(self):
        self.send_response(200)
        self.send_header('Content-type', 'text/html')
        self.send_header('Access-Control-Allow-Origin', '*')
        self.end_headers()

    def do_GET(self):
    
      global tmp_file

      print "tmp_file [" + tmp_file + "]"
      f = open(tmp_file)
      self.send_response(200)
      self.send_header('Content-type', 'text/html')
      self.send_header('Content-type', 'text/css')
      self.send_header('Access-Control-Allow-Origin', '*')
      self.end_headers()
      file_data = tmp_file
      file_data += "/"
      file_data += f.read()
      self.wfile.write(file_data)
      f.close
      return
        
    def do_HEAD(self):
        self._set_headers()
        
    def do_POST(self):
        # Parse the form data posted
        form = cgi.FieldStorage(
            fp=self.rfile, 
            headers=self.headers,
            environ={'REQUEST_METHOD':'POST',
                     'CONTENT_TYPE':self.headers['Content-Type'],
                     })

        # Begin the response
        self.send_response(200)
        self.send_header('Access-Control-Allow-Origin', '*')
        self.end_headers()

        # Echo back information about what was posted in the form
        for field in form.keys():
            field_item = form[field]
            if field_item.filename:
                # The field contains an uploaded file
                file_data = field_item.file.read()
                global tmp_file
                tmp_file = field_item.filename
                open(tmp_file, "wb").write(file_data)
                print tmp_file
        return

def run(server_class=HTTPServer, handler_class=S, port=80):
    server_address = ('127.0.0.1', port)
    httpd = server_class(server_address, handler_class)
    print 'Starting httpd...'
    httpd.serve_forever()

if __name__ == "__main__":
    from sys import argv

    if len(argv) == 2:
        run(port=int(argv[1])) #get port
    else:
        run()