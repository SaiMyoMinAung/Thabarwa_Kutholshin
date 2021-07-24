<template>
  <div class="row">
    <loading
      :active.sync="isLoading"
      :can-cancel="true"
      :is-full-page="fullPage"
    ></loading>
    <div class="col-md-12 col-lg-12 row mb-1">
      <div class="col-md-3 mb-2">
        <a
          :href="
            ShareInternalDonatedItemModel.createShareInternalDonatedItemUrl
          "
          class="btn btn-success pull-right"
          >Add Share List
        </a>
      </div>

      <div class="col-md-3 mb-2">
        <a
          class="btn btn-outline-primary"
          style="min-width: 250px"
          :href="ShareInternalDonatedItemModel.shareInternalDonatedItemIndexUrl"
          ><i class="fas fa-table"></i> Show Table</a
        >
      </div>
      <div class="col-md-6 mb-2">
        <div class="float-left mr-2">
          <add-unexpected-person-component />
        </div>
        <div class="float-left mr-2">
          <add-team-component />
        </div>
        <div class="float-left mr-2">
          <add-yogi-component />
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6 row mb-1 mt-5">
      <div class="col-md-6">
        <div class="form-group">
          <label for="item_type"
            >Item Type <span class="text-danger">*</span></label
          >
          <select2
            :url="ShareInternalDonatedItemModel.fetchItemType"
            placeholder="Select Item Type"
            :value="ShareInternalDonatedItemModel.data.item_type"
            @input="
              ShareInternalDonatedItemModel.selectedItemTypeBox($event);
              doScroll($event);
            "
            :selected-option="ShareInternalDonatedItemModel.selectedItemType"
            v-bind:class="{
              'is-invalid':
                ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
                  .item_type_id_hasError,
              'is-valid':
                ShareInternalDonatedItemModel.ShareInternalDonatedItemSubmited &&
                !ShareInternalDonatedItemModel
                  .ShareInternalDonatedItemValidation.item_type_id_hasError,
            }"
          ></select2>
          <div
            class="invalid-feedback"
            v-if="
              ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
                .item_type_id_hasError
            "
          >
            {{
              ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
                .item_type_id_errorMessage
            }}
          </div>

          <div
            class="valid-feedback"
            v-if="
              !ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
                .item_type_id_hasError &&
              ShareInternalDonatedItemModel.ShareInternalDonatedItemSubmited
            "
          >
            {{
              ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
                .item_type_id_successMessage
            }}
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="itemSubType"
            >Item Sub Type <span class="text-danger">*</span></label
          >
          <select2
            :url="ShareInternalDonatedItemModel.fetchItemSubType"
            placeholder="Select Item Sub Type"
            :value="ShareInternalDonatedItemModel.data.item_sub_type_id"
            @input="
              ShareInternalDonatedItemModel.selectedItemSubTypeBox($event);
              doItemSubTypeSelected($event);
            "
            :selected-option="ShareInternalDonatedItemModel.selectedItemSubType"
            :disabled="itemSubTypeDisabled"
            :fetch="ShareInternalDonatedItemModel.itemSubTypeFetch"
            v-bind:class="{
              'is-invalid':
                ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
                  .item_sub_type_id_hasError,
              'is-valid':
                ShareInternalDonatedItemModel.ShareInternalDonatedItemSubmited &&
                !ShareInternalDonatedItemModel
                  .ShareInternalDonatedItemValidation.item_sub_type_id_hasError,
            }"
          ></select2>
          <div
            class="invalid-feedback"
            v-if="
              ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
                .item_sub_type_id_hasError
            "
          >
            {{
              ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
                .item_sub_type_id_errorMessage
            }}
          </div>

          <div
            class="valid-feedback"
            v-if="
              !ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
                .item_sub_type_id_hasError &&
              ShareInternalDonatedItemModel.ShareInternalDonatedItemSubmited
            "
          >
            {{
              ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
                .item_sub_type_id_successMessage
            }}
          </div>
        </div>
      </div>

      <div class="form-group col-md-6">
        <label for="requestable_type"
          >Requestable Type <span class="text-danger">*</span></label
        >
        <select2
          :url="ShareInternalDonatedItemModel.getRequestableTypeUrl"
          placeholder="Select Requestable Type"
          :value="ShareInternalDonatedItemModel.requestable_type"
          @input="
            ShareInternalDonatedItemModel.selectedRequestableTypeBox($event)
          "
          :selected-option="
            ShareInternalDonatedItemModel.selectedRequestableType
          "
          v-bind:class="{
            'is-invalid':
              ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
                .requestable_type_hasError,
            'is-valid':
              ShareInternalDonatedItemModel.ShareInternalDonatedItemSubmited &&
              !ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
                .requestable_type_hasError,
          }"
        ></select2>
        <div
          class="invalid-feedback"
          v-if="
            ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
              .requestable_type_hasError
          "
        >
          {{
            ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
              .requestable_type_errorMessage
          }}
        </div>

        <div
          class="valid-feedback"
          v-if="
            !ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
              .requestable_type_hasError &&
            ShareInternalDonatedItemModel.ShareInternalDonatedItemSubmited
          "
        >
          {{
            ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
              .requestable_type_successMessage
          }}
        </div>
      </div>

      <div class="form-group col-md-6">
        <label for="requestable_type"
          >Requestable Person <span class="text-danger">*</span></label
        >
        <select2
          :disabled="
            ShareInternalDonatedItemModel.data.requestable_type == ''
              ? true
              : false
          "
          :url="ShareInternalDonatedItemModel.getRequestableTypeIdUrl"
          :fetch="ShareInternalDonatedItemModel.RequestablePersonFetch"
          placeholder="Select Requestable Person"
          :value="ShareInternalDonatedItemModel.data.requestable_id"
          @input="
            ShareInternalDonatedItemModel.selectedRequestableTypeIdBox($event)
          "
          :selected-option="
            ShareInternalDonatedItemModel.selectedRequestableTypeId
          "
          v-bind:class="{
            'is-invalid':
              ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
                .requestable_id_hasError,
            'is-valid':
              ShareInternalDonatedItemModel.ShareInternalDonatedItemSubmited &&
              !ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
                .requestable_id_hasError,
          }"
        ></select2>
        <div
          class="invalid-feedback"
          v-if="
            ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
              .requestable_id_hasError
          "
        >
          {{
            ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
              .requestable_id_errorMessage
          }}
        </div>

        <div
          class="valid-feedback"
          v-if="
            !ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
              .requestable_id_hasError &&
            ShareInternalDonatedItemModel.InternalRequestSubmited
          "
        >
          {{
            ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
              .requestable_id_successMessage
          }}
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="socket_qty"
            >Socket Qty <span class="text-danger">*</span></label
          >
          <input
            name="socket_qty"
            id="socket_qty"
            type="text"
            class="form-control only-number"
            placeholder="Enter Socket Qty"
            v-model="ShareInternalDonatedItemModel.data.socket_qty"
            v-bind:class="{
              'is-invalid':
                ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
                  .socket_qty_hasError,
              'is-valid':
                ShareInternalDonatedItemModel.ShareInternalDonatedItemSubmited &&
                !ShareInternalDonatedItemModel
                  .ShareInternalDonatedItemValidation.socket_qty_hasError,
            }"
          />
          <div
            class="invalid-feedback"
            v-if="
              ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
                .socket_qty_hasError
            "
          >
            {{
              ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
                .socket_qty_errorMessage
            }}
          </div>

          <div
            class="valid-feedback"
            v-if="
              !ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
                .socket_qty_hasError &&
              ShareInternalDonatedItemModel.ShareInternalDonatedItemSubmited
            "
          >
            {{
              ShareInternalDonatedItemModel.ShareInternalDonatedItemValidation
                .socket_qty_successMessage
            }}
          </div>
        </div>
      </div>

      <div class="col-md-6"></div>

      <div class="form-group">
        <button
          type="submit"
          class="btn btn-success m-1"
          @click="
            edit
              ? ShareInternalDonatedItemModel.updateShare()
              : ShareInternalDonatedItemModel.saveShare()
          "
        >
          {{ edit ? "Update" : "Add Share" }}
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
import ItemOfStore from "./ItemOfStore.vue";

export default {
  mounted() {
    this.getStoreList();
  },
  components: {
    select2,
    Loading,
    AddUnexpectedPersonComponent,
    AddTeamComponent,
    AddYogiComponent,
  },
  props: {
    share_internal_donated_item: { type: Object, default: () => ({}) },
  },
  data: function () {
    return {
      listOfStore: {
        component: ItemOfStore,
        itemlist: [],
      },
      fullPage: false,
      isLoading: false,
      ShareInternalDonatedItemModel: new ShareInternalDonatedItem(
        this.share_internal_donated_item
      ),
    };
  },
  computed: {
    edit() {
      return this.ShareInternalDonatedItemModel.data.uuid != "";
    },
    itemSubTypeDisabled() {
      return this.ShareInternalDonatedItemModel.data.item_type_id === "";
    },
  },
  methods: {
    getStoreList() {
      let url = route("get.store.list");
      axios
        .get(url)
        .then((response) => {
          let data = [];

          for (let i = 0; i < response.data.length; i++) {
            response.data[i].active = false;
            for (let a = 0; a < response.data[i].item_sub_type.length; a++) {
              response.data[i].item_sub_type[a].active = false;
            }
            data[i] = response.data[i];
          }
          console.log(data);
          this.listOfStore.itemlist = data;
        })
        .catch(function (error) {
          console.log(error.response);
        });
    },
    doScroll(event) {
      let itemCount = 0;

      let itemList = this.listOfStore.itemlist;

      for (let i = 0; i < itemList.length; i++) {
        itemList[i].active = false;
      }

      for (let i = 0; i < itemList.length; i++) {
        if (event != null && event.name === itemList[i].item_type) {
          itemList[i].active = true;
          break;
        } else {
          itemCount += 1;
          itemCount += itemList[i]["item_sub_type"].length;
          console.log(itemCount);
        }
      }

      document.getElementsByClassName("list")[0].scroll({
        top: 0,
        left: 0,
      });

      document.getElementsByClassName("list")[0].scroll({
        top: itemCount * 35,
        left: 0,
        behavior: "smooth",
      });

      this.doItemSubTypeSelected();
    },
    doItemSubTypeSelected(event) {
      let itemList = this.listOfStore.itemlist;

      for (let i = 0; i < itemList.length; i++) {
        for (let a = 0; a < itemList[i].item_sub_type.length; a++) {
          if (
            event != null &&
            itemList[i].item_sub_type[a].name === event.name
          ) {
            itemList[i].item_sub_type[a].active = true;
          } else {
            itemList[i].item_sub_type[a].active = false;
          }
        }
      }
    },
  },
};
</script>