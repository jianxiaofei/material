//route
require.config({
    baseUrl: "js/"
});

 require([], function() {
    var routeMap = {
        'itemApplication':{
            'page'      : 'page/itemApplication.html',
            'controller': 'itemApplicationController'
        },
        'check':{
            'page'      : 'page/check.html',
            'controller': 'checkController'
        },
        'meetingNote':{
            'page'      : 'page/meetingNote.html',
            'controller': 'meetingNoteController'
        },
        'publicity':{
            'page'      : 'page/publicity.html',
            'controller': 'publicityController'
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
