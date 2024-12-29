<template>
    <div class="row">
        <loading
            :active.sync="isLoading"
            :can-cancel="true"
            :is-full-page="fullPage"
        ></loading>
        <add-unexpected-person-component />
        <add-team-component />
        <add-yogi-component />
        <add-contribution-component />
        <div class="col-sm-6 col-md-6 col-lg-6 row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="itemSubType"
                        >{{ trans.get("input.item_sub_type") }}
                        <span class="text-danger">*</span></label
                    >
                    <select2
                        :url="ShareInternalDonatedItemModel.fetchItemSubType"
                        placeholder="Select Item Sub Type"
                        :value="
                            ShareInternalDonatedItemModel.data.item_sub_type_id
                        "
                        @input="
                            ShareInternalDonatedItemModel.selectedItemSubTypeBox(
                                $event
                            );
                            doScroll($event.original_name);
                        "
                        :selected-option="
                            ShareInternalDonatedItemModel.selectedItemSubType
                        "
                        :fetch="ShareInternalDonatedItemModel.itemSubTypeFetch"
                        v-bind:class="{
                            'is-invalid':
                                ShareInternalDonatedItemModel
                                    .ShareInternalDonatedItemValidation
                                    .item_sub_type_id_hasError,
                            'is-valid':
                                ShareInternalDonatedItemModel.ShareInternalDonatedItemSubmited &&
                                !ShareInternalDonatedItemModel
                                    .ShareInternalDonatedItemValidation
                                    .item_sub_type_id_hasError
                        }"
                    ></select2>
                    <div
                        class="invalid-feedback"
                        v-if="
                            ShareInternalDonatedItemModel
                                .ShareInternalDonatedItemValidation
                                .item_sub_type_id_hasError
                        "
                    >
                        {{
                            ShareInternalDonatedItemModel
                                .ShareInternalDonatedItemValidation
                                .item_sub_type_id_errorMessage
                        }}
                    </div>

                    <div
                        class="valid-feedback"
                        v-if="
                            !ShareInternalDonatedItemModel
                                .ShareInternalDonatedItemValidation
                                .item_sub_type_id_hasError &&
                                ShareInternalDonatedItemModel.ShareInternalDonatedItemSubmited
                        "
                    >
                        {{
                            ShareInternalDonatedItemModel
                                .ShareInternalDonatedItemValidation
                                .item_sub_type_id_successMessage
                        }}
                    </div>
                </div>
            </div>

            <div class="form-group col-md-6">
                <label for="requestable_type"
                    >{{ trans.get("input.requestable_type") }}
                    <span class="text-danger">*</span></label
                >
                <select2
                    :url="ShareInternalDonatedItemModel.getRequestableTypeUrl"
                    placeholder="Select Requestable Type"
                    :value="ShareInternalDonatedItemModel.requestable_type"
                    @input="
                        ShareInternalDonatedItemModel.selectedRequestableTypeBox(
                            $event
                        )
                    "
                    :selected-option="
                        ShareInternalDonatedItemModel.selectedRequestableType
                    "
                    v-bind:class="{
                        'is-invalid':
                            ShareInternalDonatedItemModel
                                .ShareInternalDonatedItemValidation
                                .requestable_type_hasError,
                        'is-valid':
                            ShareInternalDonatedItemModel.ShareInternalDonatedItemSubmited &&
                            !ShareInternalDonatedItemModel
                                .ShareInternalDonatedItemValidation
                                .requestable_type_hasError
                    }"
                ></select2>
                <div
                    class="invalid-feedback"
                    v-if="
                        ShareInternalDonatedItemModel
                            .ShareInternalDonatedItemValidation
                            .requestable_type_hasError
                    "
                >
                    {{
                        ShareInternalDonatedItemModel
                            .ShareInternalDonatedItemValidation
                            .requestable_type_errorMessage
                    }}
                </div>

                <div
                    class="valid-feedback"
                    v-if="
                        !ShareInternalDonatedItemModel
                            .ShareInternalDonatedItemValidation
                            .requestable_type_hasError &&
                            ShareInternalDonatedItemModel.ShareInternalDonatedItemSubmited
                    "
                >
                    {{
                        ShareInternalDonatedItemModel
                            .ShareInternalDonatedItemValidation
                            .requestable_type_successMessage
                    }}
                </div>
            </div>

            <div class="form-group col-md-6">
                <button
                    type="button"
                    class="btn btn-sm btn-info"
                    data-toggle="modal"
                    :data-target="ShareInternalDonatedItemModel.showModel"
                    v-if="
                        ShareInternalDonatedItemModel.data.requestable_type !=
                            ''
                    "
                >
                    +
                </button>
                <label for="requestable_type"
                    >{{ trans.get("input.requestable_person") }}
                    <span class="text-danger">*</span></label
                >
                <select2
                    :disabled="
                        ShareInternalDonatedItemModel.data.requestable_type ==
                        ''
                            ? true
                            : false
                    "
                    :url="ShareInternalDonatedItemModel.getRequestableTypeIdUrl"
                    :fetch="
                        ShareInternalDonatedItemModel.RequestablePersonFetch
                    "
                    placeholder="Select Requestable Person"
                    :value="ShareInternalDonatedItemModel.data.requestable_id"
                    @input="
                        ShareInternalDonatedItemModel.selectedRequestableTypeIdBox(
                            $event
                        )
                    "
                    :selected-option="
                        ShareInternalDonatedItemModel.selectedRequestableTypeId
                    "
                    v-bind:class="{
                        'is-invalid':
                            ShareInternalDonatedItemModel
                                .ShareInternalDonatedItemValidation
                                .requestable_id_hasError,
                        'is-valid':
                            ShareInternalDonatedItemModel.ShareInternalDonatedItemSubmited &&
                            !ShareInternalDonatedItemModel
                                .ShareInternalDonatedItemValidation
                                .requestable_id_hasError
                    }"
                ></select2>
                <div
                    class="invalid-feedback"
                    v-if="
                        ShareInternalDonatedItemModel
                            .ShareInternalDonatedItemValidation
                            .requestable_id_hasError
                    "
                >
                    {{
                        ShareInternalDonatedItemModel
                            .ShareInternalDonatedItemValidation
                            .requestable_id_errorMessage
                    }}
                </div>

                <div
                    class="valid-feedback"
                    v-if="
                        !ShareInternalDonatedItemModel
                            .ShareInternalDonatedItemValidation
                            .requestable_id_hasError &&
                            ShareInternalDonatedItemModel.InternalRequestSubmited
                    "
                >
                    {{
                        ShareInternalDonatedItemModel
                            .ShareInternalDonatedItemValidation
                            .requestable_id_successMessage
                    }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="package_qty"
                        >{{ trans.get("input.package_qty") }}
                        <span class="text-danger">*</span></label
                    >
                    <input
                        autocomplete="off"
                        name="package_qty"
                        id="package_qty"
                        type="text"
                        class="form-control only-number"
                        placeholder="Enter Package Qty"
                        v-model="ShareInternalDonatedItemModel.data.package_qty"
                        v-bind:class="{
                            'is-invalid':
                                ShareInternalDonatedItemModel
                                    .ShareInternalDonatedItemValidation
                                    .package_qty_hasError,
                            'is-valid':
                                ShareInternalDonatedItemModel.ShareInternalDonatedItemSubmited &&
                                !ShareInternalDonatedItemModel
                                    .ShareInternalDonatedItemValidation
                                    .package_qty_hasError
                        }"
                    />
                    <div
                        class="invalid-feedback"
                        v-if="
                            ShareInternalDonatedItemModel
                                .ShareInternalDonatedItemValidation
                                .package_qty_hasError
                        "
                    >
                        {{
                            ShareInternalDonatedItemModel
                                .ShareInternalDonatedItemValidation
                                .package_qty_errorMessage
                        }}
                    </div>

                    <div
                        class="valid-feedback"
                        v-if="
                            !ShareInternalDonatedItemModel
                                .ShareInternalDonatedItemValidation
                                .package_qty_hasError &&
                                ShareInternalDonatedItemModel.ShareInternalDonatedItemSubmited
                        "
                    >
                        {{
                            ShareInternalDonatedItemModel
                                .ShareInternalDonatedItemValidation
                                .package_qty_successMessage
                        }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="sacket_qty"
                        >{{ trans.get("input.sacket_qty") }}
                        <span class="text-danger">*</span></label
                    >
                    <input
                        autocomplete="off"
                        name="sacket_qty"
                        id="sacket_qty"
                        type="text"
                        class="form-control only-number"
                        placeholder="Enter Sacket Qty"
                        v-model="ShareInternalDonatedItemModel.data.sacket_qty"
                        v-bind:class="{
                            'is-invalid':
                                ShareInternalDonatedItemModel
                                    .ShareInternalDonatedItemValidation
                                    .sacket_qty_hasError,
                            'is-valid':
                                ShareInternalDonatedItemModel.ShareInternalDonatedItemSubmited &&
                                !ShareInternalDonatedItemModel
                                    .ShareInternalDonatedItemValidation
                                    .sacket_qty_hasError
                        }"
                    />
                    <div
                        class="invalid-feedback"
                        v-if="
                            ShareInternalDonatedItemModel
                                .ShareInternalDonatedItemValidation
                                .sacket_qty_hasError
                        "
                    >
                        {{
                            ShareInternalDonatedItemModel
                                .ShareInternalDonatedItemValidation
                                .sacket_qty_errorMessage
                        }}
                    </div>

                    <div
                        class="valid-feedback"
                        v-if="
                            !ShareInternalDonatedItemModel
                                .ShareInternalDonatedItemValidation
                                .sacket_qty_hasError &&
                                ShareInternalDonatedItemModel.ShareInternalDonatedItemSubmited
                        "
                    >
                        {{
                            ShareInternalDonatedItemModel
                                .ShareInternalDonatedItemValidation
                                .sacket_qty_successMessage
                        }}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button
                    type="submit"
                    class="btn btn-success m-1"
                    :class="{ 'btn-warning': edit }"
                    @click="
                        edit
                            ? ShareInternalDonatedItemModel.updateShare()
                            : ShareInternalDonatedItemModel.saveShare()
                    "
                >
                    {{
                        edit
                            ? trans.get("button.update")
                            : trans.get("button.create")
                    }}
                </button>
                <a
                    v-if="edit"
                    :href="
                        ShareInternalDonatedItemModel.createShareInternalDonatedItemUrl
                    "
                    class="btn btn-success pull-right"
                    >{{ trans.get("button.add_share_list") }}
                </a>
                <button
                    v-if="edit"
                    @click="shareThisPersonAgain"
                    class="btn btn-danger pull-right"
                >
                    {{ trans.get("button.share_this_person_again") }}
                </button>
            </div>
        </div>
        <div class="col-sm-6 col-md-6">
            <virtual-list
                class="list"
                style="height: 450px; overflow-y: auto"
                :data-key="'item_type'"
                :data-sources="listOfStore.itemlist"
                :data-component="listOfStore.component"
                :estimate-size="50"
                ref="virtualList"
            />
        </div>
    </div>
</template>

<script>
import ShareInternalDonatedItem from "../models/internal_donated_item/share_internal_donated_item";
import select2 from "./select2";
import Loading from "vue-loading-overlay";
import AddUnexpectedPersonComponent from "./AddUnexpectedPersonComponent.vue";
import AddTeamComponent from "./AddTeamComponent.vue";
import AddYogiComponent from "./AddYogiComponent.vue";
import AddContributionComponent from "./AddContributionComponent.vue";
import ItemOfStore from "./ItemOfStore.vue";

export default {
    mounted: function() {
        this.getStoreList(this.share_internal_donated_item);
        let url = route("auth.admin.information");
        $.get(url)
            .then(response => {
                this.ShareInternalDonatedItemModel.data.office_id =
                    response.office.id;
            })
            .catch(error => {
                console.log(error);
            });
    },
    created() {
        // this is for create page to highlight the list by scrolling
        // after adding record
        let self = this;
        this.$root.$on("successfulSaveShare", data => {
            self.successfulSaveShare = true;
            this.getStoreList(data);
        });

        this.$root.$on("teamCreateSuccess", data => {
            this.ShareInternalDonatedItemModel.data.requestable_id = data.id;
            this.ShareInternalDonatedItemModel.selectedRequestableTypeId = data;
        });

        this.$root.$on("yogiCreateSuccess", data => {
            this.ShareInternalDonatedItemModel.data.requestable_id = data.id;
            this.ShareInternalDonatedItemModel.selectedRequestableTypeId = data;
        });

        this.$root.$on("unexpectedPersonCreateSuccess", data => {
            this.ShareInternalDonatedItemModel.data.requestable_id = data.id;
            this.ShareInternalDonatedItemModel.selectedRequestableTypeId = data;
        });
        
        this.$root.$on("contributionCreateSuccess", data => {
            this.ShareInternalDonatedItemModel.data.requestable_id = data.id;
            this.ShareInternalDonatedItemModel.selectedRequestableTypeId = data;
        });
    },
    updated() {
        // this is for edit page to highlight the list by scrolling
        if (
            this.share_internal_donated_item != null &&
            this.share_internal_donated_item.selectedItemSubType !== undefined
        ) {
            this.doScroll(
                this.share_internal_donated_item.selectedItemSubType
                    .original_name
            );
        }
    },
    components: {
        select2,
        Loading,
        AddUnexpectedPersonComponent,
        AddTeamComponent,
        AddYogiComponent,
        AddContributionComponent
    },
    props: {
        share_internal_donated_item: { type: Object, default: () => ({}) }
    },
    data: function() {
        return {
            successfulSaveShare: false,
            listOfStore: {
                component: ItemOfStore,
                itemlist: []
            },
            fullPage: false,
            isLoading: false,
            ShareInternalDonatedItemModel: new ShareInternalDonatedItem(
                this.share_internal_donated_item
            )
        };
    },
    computed: {
        edit() {
            return this.ShareInternalDonatedItemModel.data.uuid != "";
        }
    },
    methods: {
        shareThisPersonAgain() {
            this.ShareInternalDonatedItemModel.data.uuid = "";
            this.ShareInternalDonatedItemModel.data["_method"] = "POST";
        },
        getStoreList(responseData) {
            let url = route("get.store.list");
            axios
                .get(url)
                .then(response => {
                    let data = [];
                    for (let i = 0; i < response.data.length; i++) {
                        response.data[i].active = false;
                        for (
                            let a = 0;
                            a < response.data[i].item_sub_type.length;
                            a++
                        ) {
                            response.data[i].item_sub_type[a].active = false;
                        }
                        data[i] = response.data[i];
                    }

                    this.listOfStore.itemlist = data;

                    if (
                        this.successfulSaveShare &&
                        responseData != null &&
                        responseData != undefined
                    ) {
                        this.doScroll(
                            responseData.selectedItemSubType.original_name
                        );
                    }
                })
                .catch(function(error) {
                    console.log(error.response);
                });
        },
        doScroll(name) {
            let itemCount = 0;

            let itemList = this.listOfStore.itemlist;

            for (let i = 0; i < itemList.length; i++) {
                itemList[i].active = false;
            }

            // for (let i = 0; i < itemList.length; i++) {
            //   if (name != null && name === itemList[i].item_type) {
            //     itemList[i].active = true;
            //     break;
            //   } else {
            //     itemCount += 1;
            //     // itemCount += itemList[i]["item_sub_type"].length;
            //   }
            // }
            if (name != null) {
                loop1: for (let i = 0; i < itemList.length; i++) {
                    console.log(itemList[i].item_type);
                    for (
                        let a = 0;
                        a < itemList[i]["item_sub_type"].length;
                        a++
                    ) {
                        if (name === itemList[i]["item_sub_type"][a].name) {
                            itemList[i].active = true;
                            break loop1;
                        }
                    }
                    itemCount += 1;
                }
            }

            this.$refs.virtualList.scrollToIndex(0);

            // document.getElementsByClassName("list")[0].scroll({
            //   top: 0,
            //   left: 0,
            // });

            this.$refs.virtualList.scrollToIndex(itemCount);

            // document.getElementsByClassName("list")[0].scroll({
            //   top: itemCount * 60,
            //   left: 0,
            //   behavior: "smooth",
            // });

            this.doItemSubTypeSelected(name);
        },
        doItemSubTypeSelected(name) {
            let itemList = this.listOfStore.itemlist;

            for (let i = 0; i < itemList.length; i++) {
                for (let a = 0; a < itemList[i].item_sub_type.length; a++) {
                    if (
                        name != null &&
                        itemList[i].item_sub_type[a].name === name
                    ) {
                        itemList[i].item_sub_type[a].active = true;
                    } else {
                        itemList[i].item_sub_type[a].active = false;
                    }
                }
            }
        }
    }
};
</script>
