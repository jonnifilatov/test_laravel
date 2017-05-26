/**
 * Created by jonni on 24.05.17.
 */
var task_list;
$(document).ready(function(){
    task_list = new TaskList();
    task_list.load();
});

TaskList = function(){
    this.block = $('#main');
    this.table = $('#task_list');
    this.token  = $('[name="_token"]', this.block).val();
    this.dialog = new TaskDialog(this);
    $('[name="add_task"]', this.block).on('click', $.proxy(this.add_task, this));
};

TaskList.prototype = {
    constructor: TaskList,

    add_task: function(){
        this.dialog.show();
    },

    load: function(){
        var $this = this;
        $.ajax({
            async: true,
            url: 'test/create',
            type: 'post',
            dataType: 'json',
            data: {_token:this.token},
            success:function(resp){
                if(resp.task_list != undefined)
                    $this.show(resp.task_list);
            }
        });
    },

    show:function(data){
        var target = $('#tbody'), composit;
        target.empty();
        if(data.length == 0){
            $('<tr><td>Не найдено сохранённых композитов</td></tr>').appendTo(target);
        }else{
            for(var i = 0; i<data.length; i++){
                composit = data[i];
                console.log(composit)
                $('<tr><td><a href="/test/show/id/'+ composit.id +'"> '+ composit.name +'</a></td></tr>').appendTo(target);
            }
        }
    }
};

TaskDialog = function(parent){
    this.block = $('#task_dialog');
    this.parent = parent;
    $('[name="save"]', this.block).on('click', $.proxy(this.save, this));
};

TaskDialog.prototype = {
    constructor: TaskDialog,

    show: function(){
        this.block.modal('show');
    },

    save: function(){
        var descr = $('[name="descr"]', this.block).val(),
            $this = this;
        this.block.modal('hide');
        if(descr == ''){
            alert('Введите название!');
            return false;
        }else{
            $.ajax({
                async: true,
                url: '/test/create',
                type: 'post',
                dataType: 'json',
                data: {
                    _token:this.parent.token,
                    descr:descr
                },
                success:function(resp){
                    if(resp.task_list != undefined)
                        $this.parent.show(resp.task_list);
                }
            });
        }
    }

};

