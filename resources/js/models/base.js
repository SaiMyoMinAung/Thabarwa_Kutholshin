export default class base {
    constructor(fetchListUrl = '') {
        this.fetchListUrl = fetchListUrl;
        this.fetchList();
        this.editIndex = null;
        this.id = null;
        this.validation = null;
        this.isEdit = false;
        this.isCreateSuccess = '';
        this.isCreateFail = '';
        this.isUpdateSuccess = false;
        this.isUpdateFail = '';
        this.isDeleteSuccess = '';
        this.isRestoreSuccess = '';
        this.isDeleteFail = '';
        this.isLoading = false;
        this.list = {
            data: []
        };
        this.offset = 10;
        this.page = 1;
    }

    fetchList(page) {
        if (typeof page === 'undefined') {
            page = 1;
        }

        axios
            .get(this.fetchListUrl + '?page=' + page)
            .then(response => (this.list = response.data));
    }

    /**
     * Go To Create Form
     * @param string id of <a>
     */
    goToCreate() {
        var linkId = '.dropdown-menu a[href="#' + this.createHrefId + '"]';
        var drop_down_item = $(linkId);
        drop_down_item.tab('show');
        drop_down_item.parent().parent()[0].childNodes[0].text = "Edit";
    }

    /**
     * Go To List
     * @param string id of <a>
     */
    goToList() {
        var linkId = '.dropdown-menu a[href="#' + this.listHrefId + '"]';
        var drop_down_item = $(linkId);
        drop_down_item.tab('show');
        drop_down_item.parent().parent()[0].childNodes[0].text = drop_down_item.text();
    }

    /**
     * Go To When Click Edit Yes Button
     */
    edit(index) {
        var editRecord = this.list.data[index]
        this.editIndex = index;
        Object.assign(this, editRecord);

        this.isEdit = true;
        this.validation = null;
        this.goToCreate();
    }

    /**
     * Save To Database
     * @param string url
     * @param {*} data 
     */
    save(url, data) {
        var self = this;
        this.resetIsCondition()

        axios.post(url, data)
            .then(response => {
                this.createSuccessful(response.data);
                this.goToList()
            })
            .catch(function (error) {
                self.createFail(error.response.data.errors);
            });
    }

    /**
     * Update To Database
     * @param string url 
     * @param {*} data 
     */
    update(url, data) {
        self = this;
        this.resetIsCondition();

        axios.post(url, data)
            .then(response => {
                this.updateSuccessful(response.data)
                this.goToList()
            })
            .catch(function (error) {
                self.updateFail(error.response.data.errors)
            });
    }

    delete(url, index) {
        var self = this;
        this.resetIsCondition()

        axios.delete(url)
            .then(response => {
                if (response.status === 200) {

                    this.isLoading = false;

                    console.log(this.list.data[index])
                    if (this.list.data[index].deleted_at === null) {
                        this.isDeleteSuccess = true;
                    } else {
                        this.isRestoreSuccess = true;
                    }
                    // this.list.data.splice(index, 1);

                    if (this.list.data.length === 0) {
                        this.fetchList(this.page)
                        if (this.list.data.length === 0) {
                            this.fetchList(this.page + 1);
                            if (this.list.data.length === 0) {
                                this.fetchList(this.page - 1);
                            }
                        }
                    }

                }
            })
            .catch(function (error) {
                self.isLoading = false
                self.isDeleteFail = true;
            })
    }

    /**
     * Do When Create Successful
     * @param {axio respose} responseData 
     */
    createSuccessful(responseData) {
        this.fetchList(1);
        this.isLoading = false;
        this.isCreateSuccess = true;
        this.clearData();
    }

    /**
     * Do When Create Fail
     * @param {axio error} error 
     */
    createFail(error) {
        this.isLoading = false
        this.isCreateFail = true;
        this.validation = error;
    }

    /**
     * Do When Upate Success
     * @param {axio response} responseData 
     */
    updateSuccessful(responseData) {
        this.list.data[this.editIndex] = responseData;
        this.isLoading = false;
        this.isUpdateSuccess = true;
        this.isEdit = false;
        this.editIndex = null;
        this.id = null;
        this.validation = null;
        this.clearData();
    }

    /**
     * Do When Upate Success
     * @param {axio error} responseData 
     */
    updateFail(error) {
        this.isLoading = false
        this.isUpdateFail = true;
        this.validation = error;
    }

    clearData() {
        this.id = null;
        this.isEdit = false;
        this.editIndex = null;
        this.validation = null;
    }

    /**
     * Reset The Property 
     * To Work Loading And Toaster
     */
    resetIsCondition() {
        this.isLoading = true
        this.isDeleteSuccess = false;
        this.isRestoreSuccess = false;
        this.isDeleteFail = false;
        this.isCreateSuccess = false;
        this.isCreateFail = false;
        this.isUpdateSuccess = false;
        this.isUpdateFail = false;
    }
}