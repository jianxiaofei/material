//route
require.config({
    baseUrl: "js/"
});

 require([], function() {
    var routeMap = {
        'first':{
            'page'      : 'page/first.html',
            'controller': 'first'
        },
        'second':{
            'page'      : 'page/second.html',
            'controller': 'second'
        },
        'third':{
            'page'      : 'page/third.html',
            'controller': 'third'
        }
    };
    for(var name in routeMap){
        var routeobj = routeMap[name] || {};
        jsMvc.AddRoute(BaseController, name, routeobj['page']);
    }
     jsMvc.Initialize();

     function BaseController(view, model, hashurl){
         var ts = routeMap[hashurl] && routeMap[hashurl]['controller'];
         require(['controller/' + ts], function(Controller){
             // Controller(view, model, hashurl);
             try {
                 Controller(view, model, hashurl);
             }catch (err){
                 // alert(11)
                 //do nothing
             }
         });
     }
});
