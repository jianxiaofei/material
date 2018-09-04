define([], function () {
    var publicityController = function (view, model, hash) {


        //日期控件
        $('#dateTimeRange').daterangepicker({
            applyClass : 'btn-sm btn-success',
            cancelClass : 'btn-sm btn-default',
            locale: {
                applyLabel: '确认',
                cancelLabel: '取消',
                fromLabel : '起始时间',
                toLabel : '结束时间',
                customRangeLabel : '自定义',
                daysOfWeek: ['日','一','二','三','四','五','六'],
                monthNames: [ "一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
                firstDay : 1,

            },
            ranges : {
                //'最近1小时': [moment().subtract('hours',1), moment()],
                '今日': [moment().startOf('day'), moment()],
                '昨日': [moment().subtract('days', 1).startOf('day'), moment().subtract('days', 1).endOf('day')],
                '最近7日': [moment().subtract('days', 6), moment()],
                '最近30日': [moment().subtract('days', 29), moment()],
                '本月': [moment().startOf("month"),moment().endOf("month")],
                '上个月': [moment().subtract(1,"month").startOf("month"),moment().subtract(1,"month").endOf("month")]
            },
            opens : 'left',    // 日期选择框的弹出位置
            separator : ' 至 ',
            showWeekNumbers : true,     // 是否显示第几周
            showDropdowns: true,
            //maxDate : moment(),           // 最大时间
            format: 'YYYY-MM-DD'
        },
            function(start, end, label) { // 格式化日期显示框
            $('#beginTime').val(start.format('YYYY-MM-DD'));
            $('#endTime').val(end.format('YYYY-MM-DD'));
        })
            .next().on('click', function(){
            $(this).prev().focus();
        });

    // alert('走完')
    };
    return publicityController;
});
