# The Descent

### [Link](https://www.codingame.com/ide/puzzle/the-descent)

Write a program that destroys the mountains in order to land. To do this, shoot at the highest mountain.

#### Rules 
At the beginning of each game turn, you receive as input the height of each mountain from left to right.  
Before the end of the game turn, you must indicate the highest mountain to shoot at.

Shooting at a mountain will only destroy part of it. Your ship descends with each pass.

#### Victory conditions
You win if you destroy the highest mountain at each turn.

#### Defeat conditions  
Your ship crashes into a mountain.  
You provide an invalid output or your program does not respond in time.

**Note:** Do not forget to run the tests from the "Test cases" window. The provided tests and the validators used for scoring are slightly different to prevent hardcoded solutions.

### Game Input  
The program must read the mountain heights from standard input and then output the index of the mountain to destroy to standard output.

#### Input for one game turn  
8 lines: one integer mountainH per line. It represents the height of a mountain. The mountain heights are given in order of their index (from 0 to 7).

### Output for one game turn  
A single line containing the number of the mountain to shoot at.

### Constraints  
0 ≤ mountainH ≤ 9  
Response time per turn ≤ 100ms
