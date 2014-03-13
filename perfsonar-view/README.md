Visible at http://www.mwt2.org/perfsonar_view/

### Howto

throughput.php and latency.php both do essentially the same thing, just with different graphs and different frame sizes.

There are two associative arrays that are used to generate the graphs:
* lengths: Contains the time frames that the graphs are over (name => time in seconds)
* URLs: Contains the graph URLs from the perfsonar webservice. Replace the 'length' parameter in the URL with {0} so that it can be replaced with the lengths chosen from the 'lengths' object'

addFrames() is what generates the graphs on load, and whenever the graphs are changed. 
