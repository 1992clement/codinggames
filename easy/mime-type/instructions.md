# Mime-type

### [Link](https://www.codingame.com/ide/puzzle/mime-type)
The MIME type is used in many internet protocols to associate a media type (html, image, video, ...) with the transmitted content. This MIME type is generally deduced from the extension of the file to be transferred.

You must write a program that detects the MIME type of a file based on its name.

**Rules:**   
A table that associates a MIME type with a file extension is provided. A list of file names to be transferred will also be provided, and you must determine for each of them the MIME type to use.

A file extension is defined as the part of the name that appears after the last dot in the filename.  
If the file extension is present in the association table (case does not matter, e.g., TXT is equivalent to txt), then display the corresponding MIME type. If it is not possible to find the MIME type associated with a file, or if the file has no extension, display UNKNOWN.

### Input
Line 1: Integer N, the number of elements in the association table.

Line 2: Integer Q, the number of file names to analyze.

The next N lines: One file extension per line and its corresponding MIME type (separated by a space).

The next Q lines: One file name per line.

### Output
For each of the Q file names, output on a separate line the corresponding MIME type. If there is no match, output UNKNOWN.

### Constraints
0 < N < 10000  
0 < Q < 10000  
File extensions consist of at most 10 ASCII alphanumeric characters.  
MIME types consist of at most 50 ASCII alphanumeric characters and punctuation marks.  
File names consist of at most 256 ASCII alphanumeric characters and dots.  
There are no spaces in file names, extensions, or MIME types.