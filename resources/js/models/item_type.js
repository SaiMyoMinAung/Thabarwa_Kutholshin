import base from "./base.js";

export default class ItemType extends base {
    constructor() {
        super(route('item_types.index'));
        this.name = '';
        this.listHrefId = "item-type-list";
        this.createHrefId = "item-type-list-create";
    }

    editRecord(index) {
        super.edit(index);
    }

    clearData() {
        super.clearData()
        this.name = '';
    }

    updateItemType() {
        var url = route('item_types.update', this.id);
        var data = { name: this.name, _method: "PUT" };
        super.update(url, data)
    }

    saveItemType() {
        var data = { name: this.name };
        var url = route('item_types.store');
        super.save(url, data);
    }

    deleteItemType(id, index) {
        var url = route('item_types.destroy', id);
        super.delete(url, index)
    }

}