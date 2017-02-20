#!/usr/bin/python
# -*- encoding:utf-8 -*-

import sys, math
from math import *

def main(args):

	if len(args) < 3:
		print "USAGE: ./IP taux_actualisation investissement [nombre d'annees]";
		sys.exit(2);

	taux_actu = 1.0 + float(int(args[0])/100.0);
	investissement = float(args[1]);
	size = len(args) - 1;
	result = 0.0;
	print "Investissement => %.2f" % investissement;
	print "Taux actualisation => %.2f" % taux_actu;
	print "Nombre annees => %d" % size;
	for x in xrange(1, size):
		result += (float(args[x+1]) / math.pow(float(taux_actu), int(x)));
		print "Args %.2f | result %.2f" % (float(args[x + 1]), result); 
	print "IP => %.4f" % float(result / investissement);
	print "VAN => %.4f" % float(result - investissement);


if __name__ == "__main__":
    main(sys.argv[1:])