# Unary

### [Link](https://www.codingame.com/ide/puzzle/unary)

Binary with 0's and 1's is good. Binary with only 0's (almost) is better.
Write a program which, from an input message, will output the message encoded with the following rules

**Rules:**
- The input message is made of ASCII (7 bits) characters only  
- The output message is made of blocs of 0's
- Blocs are separated by "space" characters
- Two following blocs produce a byte sequence of same value (only 1's or only 0's) :  
  - First bloc : always equals 0 or 00. If 0 the sequence will contain 1's, otherwise, it will contain 0's
  - Second bloc : the number of 0's in this bloc matches the number of bytes in the sequence

### Exemple
Let's take a simple message of only 1 character : C uppercase. C in binary equals 1000011 which gives us:

```
0 0 (first sequence made of a single 1)
00 0000 (second sequence made of four 0's)
0 00 (third sequence made of two 1's)
C equals : 0 0 00 0000 0 00
```

Second example with the message CC (the 14 following bytes 10000111000011) :

```
0 0 (a single 1)
00 0000 (four 0's)
0 000 (three 1's)
00 0000 (four 0's)
0 00 (two 1's)
CC equals : 0 0 00 0000 0 000 00 0000 0 00
```

### Input
Line 1 : the message made of N ASCII characters (without carriage return)

### Output
The encoded message

### Constraints
0 < N < 100