<template>
    <div class="row">
        <loading
            :active.sync="isLoading"
            :can-cancel="true"
            :is-full-page="fullPage"
        ></loading>
        <div class="col-md-12 col-lg-12 row mb-1">
            <div class="col-md-3">
                <a
                    :href="
                        InternalDonatedItemModel.internalDonatedItemCreateUrl
                    "
                    class="btn btn-success"
                    >{{ trans.get("button.add_new_item_to_store") }}</a
                >
            </div>
            <div class="col-md-3">
                <a
                    class="btn btn-outline-primary"
                    style="min-width: 250px"
                    :href="InternalDonatedItemModel.internalDonatedItemIndexUrl"
                    ><i class="fas fa-table"></i>
                    {{ trans.get("button.show_table") }}</a
                >
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-centered">
            <div class="card border border-success" style="min-height: 550px">
                <div class="card-body row">
                    <div class="col-md-9" v-if="edit">
                        <h3>
                            <span
                                v-bind:class="{
                                    'badge badge-danger':
                                        InternalDonatedItemModel.data.status ===
                                        'Lost',
                                    'badge badge-success':
                                        InternalDonatedItemModel.data.status ===
                                        'Available'
                                }"
                            >
                                {{
                                    InternalDonatedItemModel.data.item_unique_id
                                }}
                            </span>
                            -
                            <span
                                v-bind:class="{
                                    'badge badge-danger':
                                        InternalDonatedItemModel.data.status ===
                                        'Lost',
                                    'badge badge-success':
                                        InternalDonatedItemModel.data.status ===
                                        'Available'
                                }"
                            >
                                {{ InternalDonatedItemModel.data.status }}
                            </span>
                            -
                            <span
                                v-bind:class="{
                                    'badge badge-success':
                                        InternalDonatedItemModel.data.is_confirmed,
                                    'badge badge-warning':
                                        InternalDonatedItemModel.data.is_confirmed
                                }"
                            >
                                {{ InternalDonatedItemModel.data.is_confirmed ? 'Confirmed': 'Unconfirmed' }}
                            </span>
                        </h3>
                    </div>
                    <div class="col-md-3">
                        <div class="" v-if="showRequestControl">
                            <div
                                class="form-group"
                                v-if="
                                    InternalDonatedItemModel.data.status !=
                                        'Complete'
                                "
                            >
                                <div
                                    class="
                    custom-control
                    custom-switch
                    custom-switch-off-danger
                    custom-switch-on-success
                  "
                                >
                                    <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        id="is_left_item"
                                        :checked="
                                            InternalDonatedItemModel.data
                                                .status == 'Available'
                                                ? true
                                                : false
                                        "
                                        @click="
                                            InternalDonatedItemModel.controlAvailable()
                                        "
                                    />
                                    <label
                                        class="custom-control-label"
                                        for="is_left_item"
                                        >{{
                                            InternalDonatedItemModel.data.status
                                        }}</label
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <add-alms-round-component
                                        class="float-left"
                                        v-if="almsRoundDisabled"
                                    />
                                    <label for="almsRound">
                                        {{ trans.get("input.alms_round")
                                        }}<span class="text-danger">*</span>
                                    </label>
                                    <select2
                                        :tabindex="1"
                                        :url="
                                            InternalDonatedItemModel.fetchAlmsRound
                                        "
                                        placeholder="Select Alms Round"
                                        :value="
                                            InternalDonatedItemModel.data
                                                .alms_round_id
                                        "
                                        @input="
                                            InternalDonatedItemModel.selectedAlmsRoundBox(
                                                $event
                                            )
                                        "
                                        :selected-option="
                                            InternalDonatedItemModel.selectedAlmsRound
                                        "
                                        :disabled="disabled"
                                        v-bind:class="{
                                            'is-invalid':
                                                InternalDonatedItemModel
                                                    .InternalDonatedItemValidation
                                                    .alms_round_id_hasError,
                                            'is-valid':
                                                InternalDonatedItemModel.InternalDonatedItemSubmited &&
                                                !InternalDonatedItemModel
                                                    .InternalDonatedItemValidation
                                                    .alms_round_id_hasError
                                        }"
                                    ></select2>
                                    <div
                                        class="invalid-feedback"
                                        v-if="
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .alms_round_id_hasError
                                        "
                                    >
                                        {{
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .alms_round_id_errorMessage
                                        }}
                                    </div>

                                    <div
                                        class="valid-feedback"
                                        v-if="
                                            !InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .alms_round_id_hasError &&
                                                InternalDonatedItemModel.InternalDonatedItemSubmited
                                        "
                                    >
                                        {{
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .alms_round_id_successMessage
                                        }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <add-item-type-component
                                        class="float-left"
                                        v-if="itemTypeDisabled"
                                    />
                                    <label for="item_type"
                                        >{{ trans.get("input.item_type") }}
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <select2
                                        :tabindex="2"
                                        :url="
                                            InternalDonatedItemModel.fetchItemType
                                        "
                                        placeholder="Select Item Type"
                                        :value="
                                            InternalDonatedItemModel.data
                                                .item_type
                                        "
                                        @input="
                                            InternalDonatedItemModel.selectedItemTypeBox(
                                                $event
                                            )
                                        "
                                        :selected-option="
                                            InternalDonatedItemModel.selectedItemType
                                        "
                                        :disabled="disabled"
                                        v-bind:class="{
                                            'is-invalid':
                                                InternalDonatedItemModel
                                                    .InternalDonatedItemValidation
                                                    .item_type_id_hasError,
                                            'is-valid':
                                                InternalDonatedItemModel.InternalDonatedItemSubmited &&
                                                !InternalDonatedItemModel
                                                    .InternalDonatedItemValidation
                                                    .item_type_id_hasError
                                        }"
                                    ></select2>
                                    <div
                                        class="invalid-feedback"
                                        v-if="
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .item_type_id_hasError
                                        "
                                    >
                                        {{
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .item_type_id_errorMessage
                                        }}
                                    </div>

                                    <div
                                        class="valid-feedback"
                                        v-if="
                                            !InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .item_type_id_hasError &&
                                                InternalDonatedItemModel.InternalDonatedItemSubmited
                                        "
                                    >
                                        {{
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .item_type_id_successMessage
                                        }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <add-item-sub-type-component
                                        class="float-left"
                                        v-if="!itemSubTypeDisabled"
                                    />
                                    <label for="itemSubType"
                                        >{{ trans.get("input.item_sub_type")
                                        }}<span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <select2
                                        :tabindex="3"
                                        :url="
                                            InternalDonatedItemModel.fetchItemSubType
                                        "
                                        placeholder="Select Item Sub Type"
                                        :value="
                                            InternalDonatedItemModel.data
                                                .item_sub_type_id
                                        "
                                        @input="
                                            InternalDonatedItemModel.selectedItemSubTypeBox(
                                                $event
                                            )
                                        "
                                        :selected-option="
                                            InternalDonatedItemModel.selectedItemSubType
                                        "
                                        :disabled="itemSubTypeDisabled"
                                        :fetch="
                                            InternalDonatedItemModel.itemSubTypeFetch
                                        "
                                        v-bind:class="{
                                            'is-invalid':
                                                InternalDonatedItemModel
                                                    .InternalDonatedItemValidation
                                                    .item_sub_type_id_hasError,
                                            'is-valid':
                                                InternalDonatedItemModel.InternalDonatedItemSubmited &&
                                                !InternalDonatedItemModel
                                                    .InternalDonatedItemValidation
                                                    .item_sub_type_id_hasError
                                        }"
                                    ></select2>
                                    <div
                                        class="invalid-feedback"
                                        v-if="
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .item_sub_type_id_hasError
                                        "
                                    >
                                        {{
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .item_sub_type_id_errorMessage
                                        }}
                                    </div>

                                    <div
                                        class="valid-feedback"
                                        v-if="
                                            !InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .item_sub_type_id_hasError &&
                                                InternalDonatedItemModel.InternalDonatedItemSubmited
                                        "
                                    >
                                        {{
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .item_sub_type_id_successMessage
                                        }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="unit"
                                        >{{ trans.get("input.unit") }}
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <select2
                                        :tabindex="4"
                                        :url="
                                            InternalDonatedItemModel.fetchUnit
                                        "
                                        placeholder="Select Unit"
                                        :value="
                                            InternalDonatedItemModel.data
                                                .unit_id
                                        "
                                        @input="
                                            InternalDonatedItemModel.selectedUnitBox(
                                                $event
                                            )
                                        "
                                        :selected-option="
                                            InternalDonatedItemModel.selectedUnit
                                        "
                                        :disabled="disabled"
                                        v-bind:class="{
                                            'is-invalid':
                                                InternalDonatedItemModel
                                                    .InternalDonatedItemValidation
                                                    .unit_id_hasError,
                                            'is-valid':
                                                InternalDonatedItemModel.InternalDonatedItemSubmited &&
                                                !InternalDonatedItemModel
                                                    .InternalDonatedItemValidation
                                                    .unit_id_hasError
                                        }"
                                    ></select2>
                                    <div
                                        class="invalid-feedback"
                                        v-if="
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .unit_id_hasError
                                        "
                                    >
                                        {{
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .unit_id_errorMessage
                                        }}
                                    </div>

                                    <div
                                        class="valid-feedback"
                                        v-if="
                                            !InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .unit_id_hasError &&
                                                InternalDonatedItemModel.InternalDonatedItemSubmited
                                        "
                                    >
                                        {{
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .unit_id_successMessage
                                        }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="package_qty"
                                        >{{ trans.get("input.package_qty") }}
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <input
                                        :tabindex="5"
                                        name="package_qty"
                                        id="package_qty"
                                        type="text"
                                        class="form-control only-number"
                                        :placeholder="
                                            trans.get(
                                                'input.package_qty_placeholder'
                                            )
                                        "
                                        v-model="
                                            InternalDonatedItemModel.data
                                                .package_qty
                                        "
                                        :disabled="disabled"
                                        v-bind:class="{
                                            'is-invalid':
                                                InternalDonatedItemModel
                                                    .InternalDonatedItemValidation
                                                    .package_qty_hasError,
                                            'is-valid':
                                                InternalDonatedItemModel.InternalDonatedItemSubmited &&
                                                !InternalDonatedItemModel
                                                    .InternalDonatedItemValidation
                                                    .package_qty_hasError
                                        }"
                                    />
                                    <div
                                        class="invalid-feedback"
                                        v-if="
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .package_qty_hasError
                                        "
                                    >
                                        {{
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .package_qty_errorMessage
                                        }}
                                    </div>

                                    <div
                                        class="valid-feedback"
                                        v-if="
                                            !InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .package_qty_hasError &&
                                                InternalDonatedItemModel.InternalDonatedItemSubmited
                                        "
                                    >
                                        {{
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .package_qty_successMessage
                                        }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="socket_qty"
                                        >{{ trans.get("input.sacket_qty") }}
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <input
                                        :tabindex="6"
                                        name="socket_qty"
                                        id="socket_qty"
                                        type="text"
                                        class="form-control only-number"
                                        :placeholder="
                                            trans.get(
                                                'input.sacket_qty_placeholder'
                                            )
                                        "
                                        v-model="
                                            InternalDonatedItemModel.data
                                                .socket_qty
                                        "
                                        :disabled="disabled"
                                        v-bind:class="{
                                            'is-invalid':
                                                InternalDonatedItemModel
                                                    .InternalDonatedItemValidation
                                                    .socket_qty_hasError,
                                            'is-valid':
                                                InternalDonatedItemModel.InternalDonatedItemSubmited &&
                                                !InternalDonatedItemModel
                                                    .InternalDonatedItemValidation
                                                    .socket_qty_hasError
                                        }"
                                    />
                                    <div
                                        class="invalid-feedback"
                                        v-if="
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .socket_qty_hasError
                                        "
                                    >
                                        {{
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .socket_qty_errorMessage
                                        }}
                                    </div>

                                    <div
                                        class="valid-feedback"
                                        v-if="
                                            !InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .socket_qty_hasError &&
                                                InternalDonatedItemModel.InternalDonatedItemSubmited
                                        "
                                    >
                                        {{
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .socket_qty_successMessage
                                        }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="socket_per_package"
                                        >{{
                                            trans.get(
                                                "input.sacket_per_package"
                                            )
                                        }}
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <input
                                        :tabindex="7"
                                        name="socket_per_package"
                                        id="socket_per_package"
                                        type="text"
                                        class="form-control only-number"
                                        :placeholder="
                                            trans.get(
                                                'input.sacket_per_package_placeholder'
                                            )
                                        "
                                        v-model="
                                            InternalDonatedItemModel.data
                                                .socket_per_package
                                        "
                                        :disabled="disabled"
                                        v-bind:class="{
                                            'is-invalid':
                                                InternalDonatedItemModel
                                                    .InternalDonatedItemValidation
                                                    .socket_per_package_hasError,
                                            'is-valid':
                                                InternalDonatedItemModel.InternalDonatedItemSubmited &&
                                                !InternalDonatedItemModel
                                                    .InternalDonatedItemValidation
                                                    .socket_per_package_hasError
                                        }"
                                    />
                                    <div
                                        class="invalid-feedback"
                                        v-if="
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .socket_per_package_hasError
                                        "
                                    >
                                        {{
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .socket_per_package_errorMessage
                                        }}
                                    </div>

                                    <div
                                        class="valid-feedback"
                                        v-if="
                                            !InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .socket_per_package_hasError &&
                                                InternalDonatedItemModel.InternalDonatedItemSubmited
                                        "
                                    >
                                        {{
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .socket_per_package_successMessage
                                        }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label
                                >{{ trans.get("input.remark") }}
                                <span class="text-danger">*</span></label
                            >
                            <textarea
                                :tabindex="8"
                                name="remark"
                                class="form-control"
                                rows="3"
                                :placeholder="
                                    trans.get('input.remark_placeholder')
                                "
                                :disabled="disabled"
                                v-model="InternalDonatedItemModel.data.remark"
                                v-bind:class="{
                                    'is-invalid':
                                        InternalDonatedItemModel
                                            .InternalDonatedItemValidation
                                            .remark_hasError,
                                    'is-valid':
                                        InternalDonatedItemModel.InternalDonatedItemSubmited &&
                                        !InternalDonatedItemModel
                                            .InternalDonatedItemValidation
                                            .remark_hasError
                                }"
                            ></textarea>

                            <div
                                class="invalid-feedback"
                                v-if="
                                    InternalDonatedItemModel
                                        .InternalDonatedItemValidation
                                        .remark_hasError
                                "
                            >
                                {{
                                    InternalDonatedItemModel
                                        .InternalDonatedItemValidation
                                        .remark_errorMessage
                                }}
                            </div>

                            <div
                                class="valid-feedback"
                                v-if="
                                    !InternalDonatedItemModel
                                        .InternalDonatedItemValidation
                                        .remark_hasError &&
                                        InternalDonatedItemModel.InternalDonatedItemSubmited
                                "
                            >
                                {{
                                    InternalDonatedItemModel
                                        .InternalDonatedItemValidation
                                        .remark_successMessage
                                }}
                            </div>
                        </div>

                        <div class="row">
                            <button
                                :tabindex="9"
                                type="submit"
                                class="btn btn-success m-1"
                                v-if="!disabled"
                                @click="
                                    edit
                                        ? InternalDonatedItemModel.updateItem()
                                        : InternalDonatedItemModel.saveItem()
                                "
                            >
                                {{
                                    edit
                                        ? trans.get("button.update")
                                        : trans.get("button.create")
                                }}
                            </button>
                            <input
                                :tabindex="10"
                                type="submit"
                                class="btn btn-danger m-1"
                                :value="
                                    edit
                                        ? trans.get('button.update_and_confirm')
                                        : trans.get('button.update_and_confirm')
                                "
                                name="update_and_confirm"
                                v-if="!disabled"
                                @click="
                                    edit
                                        ? InternalDonatedItemModel.updateAndConfirm()
                                        : InternalDonatedItemModel.confirmAndSaveItem()
                                "
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
*:focus {
    outline: 0 !important;
    border: 1px solid red;
}
</style>

<script>
import InternalDonatedItem from "../models/internal_donated_item/internal_donated_item";
import AddAlmsRoundComponent from "./AddAlmsRoundComponent";
import select2 from "./select2";
import Loading from "vue-loading-overlay";
import AddItemTypeComponent from "./AddItemTypeComponent.vue";
import AddItemSubTypeComponent from "./AddItemSubTypeComponent.vue";

export default {
    components: {
        select2,
        Loading,
        AddAlmsRoundComponent,
        AddItemTypeComponent,
        AddItemSubTypeComponent
    },
    props: {
        internal_donated_item: { type: Object, default: () => ({}) }
    },
    data: function() {
        return {
            fullPage: false,
            isLoading: false,
            InternalDonatedItemModel: new InternalDonatedItem(
                this.internal_donated_item
            )
        };
    },
    mounted() {
        //
    },
    computed: {
        edit() {
            return this.InternalDonatedItemModel.data.uuid != "";
        },
        disabled() {
            return this.InternalDonatedItemModel.data.is_confirmed;
        },
        itemTypeDisabled() {
            return !this.InternalDonatedItemModel.data.is_confirmed;
        },
        almsRoundDisabled() {
            return !this.InternalDonatedItemModel.data.is_confirmed;
        },
        itemSubTypeDisabled() {
            return (
                this.InternalDonatedItemModel.data.is_confirmed ||
                this.InternalDonatedItemModel.data.item_type_id === ""
            );
        },
        showRequestControl() {
            return (
                this.InternalDonatedItemModel.data.is_confirmed &&
                this.InternalDonatedItemModel.data.status != "Complete"
            );
        }
    },
    created() {
        this.$root.$on("startLoading", () => {
            this.isLoading = true;
        });

        this.$root.$on("endLoading", () => {
            this.isLoading = false;
        });

        this.$root.$on("almsRoundSuccess", data => {
            this.InternalDonatedItemModel.data.alms_round_id = data.id;
            this.InternalDonatedItemModel.selectedAlmsRound = data;
        });

        this.$root.$on("itemTypeSuccess", data => {
            this.InternalDonatedItemModel.data.item_type_id = data.id;
            this.InternalDonatedItemModel.selectedItemType = data;
            this.InternalDonatedItemModel.data.item_sub_type_id = "";
            this.InternalDonatedItemModel.selectedItemSubType = null;
            this.InternalDonatedItemModel.fetchItemSubType =
                route("item_sub_types.fetch") +
                this.InternalDonatedItemModel.data.item_type_id;
            this.InternalDonatedItemModel.itemSubTypeFetch++;
        });

        this.$root.$on("itemSubTypeSuccess", data => {
            this.InternalDonatedItemModel.data.item_sub_type_id = data.id;
            this.InternalDonatedItemModel.selectedItemSubType = data;
        });

        if (this.InternalDonatedItemModel.data.item_type_id !== "") {
            this.InternalDonatedItemModel.fetchItemSubType =
                route("item_sub_types.fetch") +
                this.InternalDonatedItemModel.data.item_type_id;
            this.InternalDonatedItemModel.itemSubTypeFetch++;
            console.log(this.InternalDonatedItemModel.data.item_type_id);
        }
    }
};
</script>
