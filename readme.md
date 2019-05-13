# lineups

Please make sure to run the queries in queries.txt
All the sample data I've created will be there...

I've generated the DB structure from phpmysql. You can find it the PDF in the root, called Primedia.pdf

I did not load all the show for all the stations, esp. the weekend show. but I did load all the shows for the week days
for all 4 radion stations.

List of End Points:


URL Endpoint: 
1. "/api/lineups/{station}/{lineupdate}"
example - [http://127.0.0.1:8000/api/lineups/KFM/today]
( Given the Radio Station Shortname and a date, it will give you the shows for the day )
The keywords for the 4 radio stations are as follow: 
KFM, 702, CapeTalk, 947

Special String for lineupdate are today, tomorrow, yesterday & all. Otherwise, supply a date in the follow format '2019-05-13' ('yyyy-mm-dd')

2. "/api/djslots/{period}/{name_surnane_str}"
example - [http://127.0.0.1:8000/api/djslots/thisweek/Phemelo]

period - lastweek/thisweek/nextweek
name_surnane_str - name or surname of a DJ. Name can be shorted ie first 3/4 letters

( Get all the slots for a DJ for specified (predefined) period )

3. I can safely say that this is not 2/3 hours work.
