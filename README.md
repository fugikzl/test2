
## TEST TASK

<h3>Required openApi 3.0 documentation: HOLODILNIK.yaml</h3>


<h2>Endpoints:</h2>

- yourhost.com/api/location - get all locations

    METHOD:GET
- yourhost.com/api/container/{id} - get all containers by location id  

    METHOD:GET
- yourhost.com/api/order/calculate - check is available to store, if yes, return daily price

    METHOD:POST
    
    Required params:
        
            -locationId type:integer
            -temperature type:integer
            -volume type:integer
        
- yourhost.com/api/order 

    METHOD:POST
    
    Required params:
        
            -locationId type:integer
            -temperature type:integer
            -volume type:integer
        
