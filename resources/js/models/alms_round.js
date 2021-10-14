import base from "./base.js";

export default class AlmsRound extends base {
    constructor() {
        super(route('alms_rounds.index'));
        this.name = '';
        this.center_id = '';
        this.center = null;
        this.listHrefId = "alms-round-list";
        this.createHrefId = "alms-round-list-create";
    }

    editRecord(index) {
        super.edit(index);
    }

    clearData() {
        super.clearData()
        this.name = '';
    }

    almsRoundSelected($event) {
        this.center = $event;
        this.center_id = ($event != null) ? $event.id : "";
    }

    updateAlmsRound() {
        var url = route('alms_rounds.update', this.id);
        var data = { name: this.name, center_id: this.center_id, _method: "PUT" };
        super.update(url, data)
    }

    saveAlmsRound() {
        var data = { name: this.name, center_id: this.center_id };
        var url = route('alms_rounds.store');
        super.save(url, data);
    }

    deleteAlmsRound(id, index) {
        var url = route('alms_rounds.destroy', id);
        super.delete(url, index)
    }

}