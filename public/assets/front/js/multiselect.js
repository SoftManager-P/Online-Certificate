//Varun Dewan 2019
var $m = {
   get: function(selector){ 
      var ele = document.querySelectorAll(selector);
      for(var i = 0; i < ele.length; i++){
         this.init(ele[i]);
      }
      return ele;
   },
   template: function(html){
      var template = document.createElement('div');
      template.innerHTML = html.trim();
      return this.init(template.childNodes[0]);
   },
   init: function(ele){
      ele.on = function(event, func){ this.addEventListener(event, func); }
      return ele;
   }
};

//Build the plugin
var drop = function(info){var o = {
   options: info.options,
   selected: info.selected || [],
   preselected: info.preselected || [],
   open: false,
   html: {
      select: $m.get(info.selector)[0],
      options: $m.get(info.selector + ' option'),
      parent: undefined,
   },
   init: function(){
      //Setup Drop HTML
      this.html.parent = $m.get(info.selector)[0].parentNode
      this.html.drop = $m.template('<div class="drop"></div>')
      this.html.dropDisplay = $m.template('<div class="drop-display">Display</div>')
      this.html.dropOptions = $m.template('<div class="drop-options">Options</div>')
      this.html.dropScreen = $m.template('<div class="drop-screen"></div>')
      
      this.html.parent.insertBefore(this.html.drop, this.html.select)
      this.html.drop.appendChild(this.html.dropDisplay)
      this.html.drop.appendChild(this.html.dropOptions)
      this.html.drop.appendChild(this.html.dropScreen)
      //Hide old select
      this.html.drop.appendChild(this.html.select);
      
      //Core Events
      var that = this;
      this.html.dropDisplay.on('click', function(){ that.toggle() });
      this.html.dropScreen.on('click', function(){ that.toggle() });
      //Run Render
      this.load()
      this.preselect()
      this.render();
   },
   toggle: function(){
      this.html.drop.classList.toggle('open');
   },
   addOption: function(e, element){ 
      var index = Number(element.dataset.index);
      var no = this.selected.length;
      this.selected.forEach(function(select){
         // if(!select.removed){
             // no = no+1;
         // }
      })
      // var no = Number(element.dataset.no);
      this.clearStates()
      this.selected.push({
          no: Number(no),
         index: Number(index),
         state: 'add',
         removed: false
      })
      // this.options[index].state = 'remove';
      this.render()
   },
   removeOption: function(e, element){
      e.stopPropagation();
      this.clearStates()
      
      var index = Number(element.dataset.index);
      var no = Number(element.dataset.no);
      this.selected.forEach(function(select){
         if(select.no == no && !select.removed){
            select.removed = true
            select.state = 'remove'
         }

      })
      // this.options[index].state = 'add'
      this.render();
   },
   load: function(){
      this.options = [];
      for(var i = 0; i < this.html.options.length; i++){
         var option = this.html.options[i]
         this.options[i] = {
            html:  option.innerHTML,
            value: option.value,
            selected: option.selected,
            state: ''
         }
      }
   },
   preselect: function(){
      var that = this;
      this.selected = [];
      this.preselected.forEach(function(pre){
         that.selected.push({
            index: pre,
            state: 'add',
            removed: false
         })
         that.options[pre].state = 'remove';
      })
   },
   render: function(){
      this.renderDrop()
      this.renderOptions()
   },
   renderDrop: function(){ 
      var that = this;
      var parentHTML = $m.template('<div></div>')
      this.selected.forEach(function(select, index){ 
         var option = that.options[select.index];
         var childHTML = $m.template('<span class="item '+ select.state +'" data-value = "'+option.value+'">'+ option.html +'</span>')
         var childCloseHTML = $m.template(
            '<i class="fas fa-times btnclose" data-no="'+index+'" data-index="'+select.index+'" onclick="set()"></i></span>')
         childCloseHTML.on('click', function(e){ that.removeOption(e, this) })
         childHTML.appendChild(childCloseHTML)
         parentHTML.appendChild(childHTML)
      })
      this.html.dropDisplay.innerHTML = ''; 
      this.html.dropDisplay.appendChild(parentHTML)
   },
   renderOptions: function(){  
      var that = this;
      var parentHTML = $m.template('<div></div>')
      this.options.forEach(function(option, index){
         var childHTML = $m.template(
            '<a href="javascript:set();" data-index="'+index+'" data-value="'+option.value+'" class="'+option.state+'">'+ option.html +'</a>')
         childHTML.on('click', function(e){ that.addOption(e, this) })
         parentHTML.appendChild(childHTML)
      })
      this.html.dropOptions.innerHTML = '';
      this.html.dropOptions.appendChild(parentHTML)
   },
   clearStates: function(){
      var that = this;
      this.selected.forEach(function(select, index){ 
         select.state = that.changeState(select.state)
      })
      this.options.forEach(function(option){ 
         option.state = that.changeState(option.state)
      })
   },
   changeState: function(state){
      switch(state){
         case 'remove':
            return 'hide'
         case 'hide':
            return 'hide'
         default:
            return ''
       }
   },
   isSelected: function(index){
      var check = false
      this.selected.forEach(function(select){ 
         if(select.index == index && select.removed == false) check = true
      })
      return check
   }
}; o.init(); return o;}


//Set up some data
var options = [
   { html: 'cats', value: 'cats' },
   { html: 'fish', value: 'fish' },
   { html: 'squids', value: 'squids' },
   { html: 'cats', value: 'whales' },
   { html: 'cats', value: 'bikes' },
];
// var myDrop = new drop({
//             selector:  '#myMulti',
//             precelected:[0,2],
//          });

 // myDrop.toggle();
    