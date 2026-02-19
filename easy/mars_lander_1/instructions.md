# Mars Lander 1

### [Link](https://www.codingame.com/ide/puzzle/mars-lander-episode-1)

The objective of your program is to land the "Mars Lander" capsule safely, without crashing, as it contains the Opportunity rover. The “Mars Lander” capsule used to deploy the rover is controlled by a program that fails too often in the NASA simulator.

Note that this problem may seem difficult, but it is actually simple to solve. This puzzle is the first of three levels, therefore some controls are presented but are not necessary to solve this first level.

**Rules:**    
As part of the game, the simulator places Mars Lander in the Martian sky. 

![Simulation](https://www.codingame.com/fileservlet?id=2635325710601)  
The area is 7000m wide and 3000m high.
For this level, Mars Lander is positioned above the landing zone, in a vertical position, with no initial velocity.
There is a single flat landing zone on the surface of Mars, and it is at least 1000 meters wide.
Every second, based on the input parameters (position, speed, fuel, etc.), the program must output the desired rotation angle and the new thrust power of Mars Lander:

![Simulation](https://www.codingame.com/fileservlet?id=957023678862)  
Angle from -90° to 90°. Thrust power from 0 to 4.

For this level, you only need to control the thrust power: the angle must remain 0.

The game models a free fall without atmosphere. The gravity on Mars is 3.711 m/s². For a thrust power of X, a thrust equivalent to X m/s² is generated, and X liters of fuel are consumed. Therefore, a nearly vertical thrust power of 4 is required to compensate for Mars gravity.

For a landing to be successful, the capsule must:
```
land on flat ground  
land in a vertical position (angle = 0°)  
have a limited vertical speed ( ≤ 40 m/s in absolute value)  
have a limited horizontal speed ( ≤ 20 m/s in absolute value)
```

Remember that this puzzle has been simplified, therefore:
- the landing zone is directly below the lander. You can ignore rotation and always output 0 as the rotation angle.  
- you do not need to take surface coordinates into account.  
- you only need to ensure that your landing speed is between 0 and 40 m/s.  
- when the capsule is descending toward the ground, the vertical speed is negative. When the capsule is ascending, the vertical speed is positive.

**Note:**   
For this first introductory level, Mars Lander must pass a single test.

Validators are different from tests but remain very similar. A program that passes a test will pass the corresponding validator without issue.

### Input  
The program must first read the initialization data from standard input, then, in an infinite loop, read the Mars Lander data from standard input and output the movement instructions to standard output.

#### Initialization input  
- Line 1: the number surfaceN of points describing the Mars surface.  
- The next surfaceN lines: a pair of integers landX landY representing the coordinates of a surface point. Connecting these points sequentially forms the Mars surface made of line segments. For the first point, landX = 0, and for the last point, landX = 6999.

#### Input for one game turn  
- A single line containing 7 integers: **X Y hSpeed vSpeed fuel rotate power**  
- **X**, **Y** are the coordinates in meters of the capsule.  
- **hSpeed** and **vSpeed** are respectively the horizontal speed and vertical speed of Mars Lander (in m/s). Depending on the movement of Mars Lander, speeds may be negative.  
- **fuel** is the remaining fuel quantity in liters. When fuel runs out, thrust power becomes zero.  
- **rotate** is the rotation angle of Mars Lander in degrees.  
- **power** is the current thrust power of the capsule.

#### Output for one game turn  
A single line containing 2 integers: **rotate power**  
- **rotate** is the desired rotation angle for Mars Lander. Note that the effective rotation between turns is limited to +/- 15° relative to the previous angle.  
- **power** is the thrust power. 0 = off. 4 = maximum power. The effective thrust change between turns is limited to +/- 1.

### Constraints  
- 2 ≤ surfaceN < 30  
- 0 ≤ X < 7000  
- 0 ≤ Y < 3000  
- -500 < hSpeed, vSpeed < 500  
- 0 ≤ fuel ≤ 2000  
- -90 ≤ rotate ≤ 90  
- 0 ≤ power ≤ 4  
- Response time per turn ≤ 100ms