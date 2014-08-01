RentalMgmt
==========

A CRUD app component for a database designed to keep track of houses, expenses, income, and renters.  
A second component to query and display the data based from the house, expense types (e.g repairs, supplies), and date 
range chosen by user.

The CRUD component I used ASP.NET and CakePHP to design two different ones, just for the sake of experience.  I didn't
include it in the GitHub because the extra files just make it messy, since most of the code was done by the framework. 
I wanted to keep the GitHub clean of showcasing things that I had written.

So the second component is mainly for code viewing purposes only, and to show that I can connect to a db through hardcode
as well the frameworks.  As well as displaying queries.  This component takes user requested criterias on the House, and
then the house's specific expenses, and the date range.  And it will query out the amount, the date, the description, and at
the end sum it up and show you a count of items.
