# ASCII Art

### [Link](https://www.codingame.com/ide/puzzle/ascii-art)

In train stations and airports, you often see this type of display:

![station-display](https://www.codingame.com/fileservlet?id=21824381272)

Have you ever wondered how it would be possible to simulate this display in a good old terminal? We did: using ASCII art!

**Rules:**  
ASCII art allows shapes to be represented using characters. In our case, these shapes are specifically words. For example, the word "MANHATTAN" can be displayed in ASCII art like this:

```
# #  #  ### # #  #  ### ###  #  ###
### # # # # # # # #  #   #  # # # #
### ### # # ### ###  #   #  ### # #
# # # # # # # # # #  #   #  # # # #
# # # # # # # # # #  #   #  # # # #
```

Your mission: Write a program capable of displaying a line of text in ASCII art using a style provided as input.

### Input  
Line 1: The width L of a letter represented in ASCII art. All letters have the same width.

Line 2: The height H of a letter represented in ASCII art. All letters have the same height.

Line 3: The text line T, composed of N ASCII characters.

The following lines: The string ABCDEFGHIJKLMNOPQRSTUVWXYZ? represented in ASCII art.

### Output  
The text T displayed in ASCII art.  
Characters from a to z must be displayed in ASCII art using their uppercase equivalent.  
Characters not in the ranges [a-z] or [A-Z] must be displayed using the ASCII art question mark.