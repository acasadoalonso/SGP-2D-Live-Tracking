#!/bin/bash
rm *funcs.py 
cp /nfs/OGN/src/funcs/ognddbfuncs.py .
git add .
git commit
git push origin oldver

