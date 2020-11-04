import base from "./base.js";

export default class VolunteerJob extends base {
    constructor() {
        super(route('volunteer_jobs.index'));
        this.name = '';
        this.description = '';
        this.listHrefId = "volunteer-job-list";
        this.createHrefId = "volunteer-job-list-create";
    }

    editRecord(index) {
        super.edit(index);
    }

    clearData() {
        super.clearData()
        this.name = '';
        this.description = '';
    }

    updateVolunteerJob() {
        var url = route('volunteer_jobs.update', this.id);
        var data = { name: this.name, description: this.description, _method: "PUT" };
        super.update(url, data)
    }

    saveVolunteerJob() {
        var data = { name: this.name, description: this.description, };
        var url = route('volunteer_jobs.store');
        super.save(url, data);
    }

    deleteVolunteerJob(id, index) {
        var url = route('volunteer_jobs.destroy', id);
        super.delete(url, index)
    }

}