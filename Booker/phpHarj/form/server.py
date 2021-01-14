import socket

s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, True)
s.bind(('localhost', 8080))
s.listen(1)

connection, address = s.accept()
buf = connection.recv(4092)

data = b'''
HTTP/1.1 200
Content-Type: text/plain

Request was:

'''

connection.send(data)
connection.send(buf)


s.shutdown(socket.SHUT_RDWR)
s.close()
