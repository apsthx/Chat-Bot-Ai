/*
Template Name: Admin Pro Admin
Author: Wrappixel
Email: niravjoshi87@gmail.com
File: js
*/
$(function () {
    "use strict";
    // ============================================================== 
    // Sales overview
    // ============================================================== 
     new Chartist.Line('#sales-overview', {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        , series: [
          {meta:"Earning ($)", data: [0, 150, 110, 240, 200, 200, 300, 200, 380, 300, 400, 380]}
        , {meta:"Expense ($)", data: [0, 100, 70, 100, 240, 180, 220, 140, 250, 210, 340, 320]}
        , {meta:"Sales", data:   [0, 50, 30, 60, 180, 120, 180, 80, 190, 150, 240, 240]}
      ]
    }, {
        low: 0
        , high:400
        , showArea: true
        , fullWidth: true
        , showLine: false
        , chartPadding: 30
        , axisX: {
            showLabel: true
            , divisor: 1
            , showGrid: false
            , offset: 50
        }
        , plugins: [
        	Chartist.plugins.tooltip()
      	], 
      	// As this is axis specific we need to tell Chartist to use whole numbers only on the concerned axis
        axisY: {
        	onlyInteger: true
            , showLabel: true
            , scaleMinSpace: 50 
            , showGrid: true
            , offset: 10,
            labelInterpolationFnc: function(value) {
		      return (value / 100) + 'k'
		    },

        }
        
    });
     // ============================================================== 
    // Visitor
    // ============================================================== 
    
    var chart = c3.generate({
        bindto: '#visitor',
        data: {
            columns: [
                ['Other', 30],
                ['Desktop', 10],
                ['Tablet', 40],
                ['Mobile', 50],
            ],
            
            type : 'donut',
            onclick: function (d, i) { console.log("onclick", d, i); },
            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
            onmouseout: function (d, i) { console.log("onmouseout", d, i); }
        },
        donut: {
            label: {
                show: false
              },
            title:"Visits",
            width:20,
            
        },
        
        legend: {
          hide: true
          //or hide: 'data1'
          //or hide: ['data1', 'data2']
        },
        color: {
              pattern: ['#eceff1', '#745af2', '#26c6da', '#1e88e5']
        }
    });
  	  
    // ============================================================== 
    // Website Visitor
    // ============================================================== 

    var chart = new Chartist.Line('.website-visitor', {
          labels: [1, 2, 3, 4, 5, 6, 7, 8],
          series: [
            [0, 5, 6, 8, 25, 9, 8, 24]
            , [0, 3, 1, 2, 8, 1, 5, 1]
          ]}, {
          low: 0,
          high: 28,
          showArea: true,
          fullWidth: true,
          plugins: [
            Chartist.plugins.tooltip()
          ],
            axisY: {
            onlyInteger: true
            , scaleMinSpace: 40    
            , offset: 20
            , labelInterpolationFnc: function (value) {
                return (value / 1) + 'k';
            }
        },
        });
    	// Offset x1 a tiny amount so that the straight stroke gets a bounding box
        // Straight lines don't get a bounding box 
        // Last remark on -> http://www.w3.org/TR/SVG11/coords.html#ObjectBoundingBox
        chart.on('draw', function(ctx) {  
          if(ctx.type === 'area') {    
            ctx.element.attr({
              x1: ctx.x1 + 0.001
            });
          }
        });

        // Create the gradient definition on created event (always after chart re-render)
        chart.on('created', function(ctx) {
          var defs = ctx.svg.elem('defs');
          defs.elem('linearGradient', {
            id: 'gradient',
            x1: 0,
            y1: 1,
            x2: 0,
            y2: 0
          }).elem('stop', {
            offset: 0,
            'stop-color': 'rgba(255, 255, 255, 1)'
          }).parent().elem('stop', {
            offset: 1,
            'stop-color': 'rgba(38, 198, 218, 1)'
          });
        });
    
    // ============================================================== 
    // This is for the popup message while page load
    // ============================================================== 
        $.toast({
            heading: 'Welcome to Adminpro',
            text: 'Most powerfull and elegant design with tons of elements.',
            position: 'top-right',
            loaderBg: '#f33c49',
            icon: 'info',
            hideAfter: 6000,
            stack: 6
        })
    
});
