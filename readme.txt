=== sudoku_wp ===
Contributors: oreste
Donate link: http://oreste.parlatano.org
Tags: sudoku
Requires at least: 2.8
Tested up to: 3.1
Stable tag: trunk

== Description ==

- Introduction
 
As the plugin name indicates, Sudoku Wordpress plugin allows to play the homonym game as a WordPress widget. This widget was specifically developed as multi-widget, it can displays an unlimited number of widgets, the limit, if one, is given by the combined capacity of memory and speed of the client computer. 
It displays a grid 9x9 cells, composed by 9 sub-grids 3x3 cells. It generates a random sequence at the first sub-grid top left, then calculates the remaining 8 sub-grids. It fills the whole grid according to level of difficulty chosen through the appropriate plugin option.
It allows to regenerate the grid as much times as the user wishes just by reloading or refreshing the page. Once the grid is generated, displays two buttons, the first shows a hint, the other shows a complete solution.
 
- How it works
 
The plugin starts by showing a grid 9x9 cells partially filled with numbers and partially with blank cells where the user can input guessed numbers. Two buttons will also appear: “Hint” and “Solution”.

By pressing “Hint” the guessed numbers will change their colour according to the guess, a correct guess will show the guessed number with green colour, a wrong guess will result with a red colour.

By pressing “Solution” all the grid will be filled with the correct numbers.

The cells background colour can be set through the plugin options panel.
 
- How to use the plugin
 
After having installed the plugin, a panel displaying and managing all options will be available.

Available options are:

Title: title of the widget window

Holes: number of blank cells in a row

Numbers colour: colour of the numbers displayed on a grid

Table background colour: the background colour of the grid

Numbers font size: size in pixels of the numbers displayed on a grid

Numbers font family: type of font used for the numbers displayed on a grid

Table side length: table is a square, this is the value in pixels of the length of the side

Buttons font colour: colour of the characters on the button's label

Buttons background colour: the background colour of the button

Buttons left margin: distance from the left of the button in pixels 

As a further help in order to avoid errors, the number of holes is chosen by means of a selectable list, while colours are chosen by means of a graphic interface created with the help of the jQuery plugin “farbtastic”.

== Installation ==

1. Upload 'plugin-name.php' to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to the Admin Widgets panel, put the widget in place and modify its options

== Frequently Asked Questions ==

How many sudoku widgets I can use at the same time?

Sudoku widget can displays an unlimited number of widgets, the limit, if one, is given by the combined capacity of memory and speed of the client computer

== Screenshots ==

screenshot_01.jpg
screenshot_02.jpg
screenshot_03.jpg
screenshot_04.jpg
screenshot_05.jpg

== Other Notes ==

Doc page at: http://oreste.parlatano.org/wp/?p=69

Working example at: http://oreste.parlatano.org

== Changelog ==

No changes

== Upgrade Notice ==

No upgrades

== Links ==

Doc page at: http://oreste.parlatano.org/wp/?p=69

Working example at: http://oreste.parlatano.org