import base from "./base.js";

export default class ItemSubType extends base {
    constructor() {
        super(route('item_sub_types.index'));
        this.name = '';
        this.item_type_id = '';
        this.itemType = null;
        this.listHrefId = "item-sub-type-list";
        this.createHrefId = "item-sub-type-list-create";
    }

    editRecord(index) {
        super.edit(index);
    }

    clearData() {
        super.clearData()
        this.name = '';
    }

    itemTypeSelected($event) {
        this.itemType = $event;
        this.item_type_id = ($event != null) ? $event.id : "";
    }

    updateItemSubType() {
        var url = route('item_sub_types.update', this.id);
        var data = { name: this.name, item_type_id: this.item_type_id, _method: "PUT" };
        super.update(url, data)
    }

    saveItemSubType() {
        var data = { name: this.name, item_type_id: this.item_type_id };
        var url = route('item_sub_types.store');
        super.save(url, data);
    }

    deleteItemSubType(id, index) {
        var url = route('item_sub_types.destroy', id);
        super.delete(url, index)
    }

}