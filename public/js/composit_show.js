/**
 * Created by jonni on 25.05.17.
 */
var element_list;
$(document).ready(function(){
    element_list = new ElementList();
    element_list.load();
});

ElementList = function(){
    this.block = $('#main');
    this.token  = $('[name="_token"]', this.block).val();
    this.task_id  = $('[name="task_id"]', this.block).val();
    this.dialog = new ElementDialog(this);
    $('[name="add_element"]', this.block).on('click', $.proxy(this.add_element, this));
};

ElementList.prototype = {
    constructor: ElementList,

    add_element: function(){
        this.dialog.show();
    },

    load: function(){
        var $this = this;
        $.ajax({
            async: true,
            url: '/test/element_list',
            type: 'post',
            dataType: 'json',
            data: {
                _token:this.token,
                task_id: this.task_id
            },
            success:function(resp){
                if(resp.element_list != undefined)
                    $this.show(resp.element_list);
            }
        });
    },

    show:function(data){
        var target, element,
            select=$('[name="parent_id"]', this.dialog.block),
            root = $('[name="root"]', this.block);
        root.empty();
        select.empty();
        for(var i = 0; i<data.length; i++){
            element = data[i];
            if(element.parent_id != null){
                target = $('#'+element.parent_id);
                $('<div id="'+element.id+'" class="bordered col-xs-4"><h2>'+element.descr+'</h2></div>').appendTo(target);
            }
            $('<option value="'+element.id+'">'+element.descr+'</option>').appendTo(select);
        }
    }
};

ElementDialog = function(parent){
    this.block = $('#element_dialog');
    this.parent = parent;
    $('[name="save"]', this.block).on('click', $.proxy(this.save, this));
};

ElementDialog.prototype = {
    constructor: ElementDialog,

    show: function(){
        $('[name="descr"]', this.block).val('');
        $('[name="parent_id"]', this.block).find('option').removeAttr('selected');
        this.block.modal('show');
    },

    save: function(){
        var descr = $('[name="descr"]', this.block).val(),
            parent_id = $('[name="parent_id"]', this.block).val(),
            $this = this;
        this.block.modal('hide');
        if(descr == ''){
            alert('Введите название!');
            return false;
        }else{
            $.ajax({
                async: true,
                url: '/test/element_list',
                type: 'post',
                dataType: 'json',
                data: {
                    _token:this.parent.token,
                    parent_id: parent_id,
                    descr:descr,
                    task_id: this.parent.task_id
                },
                success:function(resp){
                    if(resp.element_list != undefined)
                        $this.parent.show(resp.element_list);
                }
            });
        }
    }

};
