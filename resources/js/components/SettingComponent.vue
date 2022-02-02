<template>
  <div>
    <loading
      :active.sync="isLoading"
      :can-cancel="true"
      :is-full-page="fullPage"
    ></loading>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <span class="badge badge-warning">1</span>
      <li
        class="nav-item dropdown"
        role="presentation"
        style="min-width: 150px"
      >
        <a
          class="nav-link dropdown-toggle active store-setting"
          data-toggle="dropdown"
          href="#"
          role="button"
          aria-haspopup="true"
          aria-expanded="false"
          >Office</a
        >
        <div class="dropdown-menu">
          <a
            class="dropdown-item"
            id="office-list-tab"
            data-toggle="tab"
            href="#office-list"
            role="tab"
            aria-controls="office-list"
            aria-selected="true"
            >Office List</a
          >
          <a
            class="dropdown-item"
            id="office-list-create-tab"
            data-toggle="tab"
            href="#office-list-create"
            role="tab"
            aria-controls="office-list-create"
            aria-selected="false"
            @click="office.model.clearData()"
            >Create Office</a
          >
        </div>
      </li>
      <!-- <span class="badge badge-warning">2</span>
      <li
        class="nav-item dropdown"
        role="presentation"
        style="min-width: 150px"
      >
        <a
          class="nav-link dropdown-toggle store-setting"
          data-toggle="dropdown"
          href="#"
          role="button"
          aria-haspopup="true"
          aria-expanded="false"
          >Store</a
        >
        <div class="dropdown-menu">
          <a
            class="dropdown-item"
            id="store-list-tab"
            data-toggle="tab"
            href="#store-list"
            role="tab"
            aria-controls="store-list"
            aria-selected="true"
            >Store List</a
          >
          <a
            class="dropdown-item"
            id="store-list-create-tab"
            data-toggle="tab"
            href="#store-list-create"
            role="tab"
            aria-controls="store-list-create"
            aria-selected="false"
            @click="store.model.clearData()"
            >Create Store</a
          >
        </div>
      </li> -->
      <!-- <span class="badge badge-warning">3</span>
      <li
        class="nav-item dropdown"
        role="presentation"
        style="min-width: 150px"
      >
        <a
          class="nav-link dropdown-toggle store-setting"
          data-toggle="dropdown"
          href="#"
          role="button"
          aria-haspopup="true"
          aria-expanded="false"
          >Box</a
        >
        <div class="dropdown-menu">
          <a
            class="dropdown-item"
            id="box-list-tab"
            data-toggle="tab"
            href="#box-list"
            role="tab"
            aria-controls="box-list"
            aria-selected="true"
            >Box List</a
          >
          <a
            class="dropdown-item"
            id="box-list-create-tab"
            data-toggle="tab"
            href="#box-list-create"
            role="tab"
            aria-controls="box-list-create"
            aria-selected="false"
            @click="box.model.clearData()"
            >Create Box</a
          >
        </div>
      </li> -->
      <span class="badge badge-success">1</span>
      <li
        class="nav-item dropdown"
        role="presentation"
        style="min-width: 150px"
      >
        <a
          class="nav-link dropdown-toggle location-setting"
          data-toggle="dropdown"
          href="#"
          role="button"
          aria-haspopup="true"
          aria-expanded="false"
          >Country</a
        >
        <div class="dropdown-menu">
          <a
            class="dropdown-item"
            id="country-list-tab"
            data-toggle="tab"
            href="#country-list"
            role="tab"
            aria-controls="country-list"
            aria-selected="false"
            >Country List</a
          >
          <a
            class="dropdown-item"
            id="country-list-create-tab"
            data-toggle="tab"
            href="#country-list-create"
            role="tab"
            aria-controls="country-list-create"
            aria-selected="false"
            @click="country.model.clearData()"
            >Create Country</a
          >
        </div>
      </li>
      <span class="badge badge-success">2</span>
      <li
        class="nav-item dropdown"
        role="presentation"
        style="min-width: 180px"
      >
        <a
          class="nav-link dropdown-toggle location-setting"
          data-toggle="dropdown"
          href="#"
          role="button"
          aria-haspopup="true"
          aria-expanded="false"
          >State Region</a
        >
        <div class="dropdown-menu">
          <a
            class="dropdown-item"
            id="state-region-list-tab"
            data-toggle="tab"
            href="#state-region-list"
            role="tab"
            aria-controls="state-region-list"
            aria-selected="false"
            >State Region List</a
          >
          <a
            class="dropdown-item"
            id="state-region-list-create-tab"
            href="#state-region-list-create"
            data-toggle="tab"
            role="tab"
            aria-controls="city-list-create"
            aria-selected="false"
            @click="stateRegion.model.clearData()"
            >Create State Region</a
          >
        </div>
      </li>
      <span class="badge badge-success">3</span>
      <li
        class="nav-item dropdown"
        role="presentation"
        style="min-width: 150px"
      >
        <a
          class="nav-link dropdown-toggle location-setting"
          data-toggle="dropdown"
          href="#"
          role="button"
          aria-haspopup="true"
          aria-expanded="false"
          >City</a
        >
        <div class="dropdown-menu">
          <a
            class="dropdown-item"
            id="city-list-tab"
            data-toggle="tab"
            href="#city-list"
            role="tab"
            aria-controls="city-list"
            aria-selected="false"
            >City List</a
          >
          <a
            class="dropdown-item"
            id="city-create-tab"
            href="#city-list-create"
            data-toggle="tab"
            role="tab"
            aria-controls="city-list-create"
            aria-selected="false"
            @click="city.model.clearData()"
            >Create City</a
          >
        </div>
      </li>
      <span class="badge badge-primary">1</span>
      <li
        class="nav-item dropdown"
        role="presentation"
        style="min-width: 150px"
      >
        <a
          class="nav-link dropdown-toggle center-setting"
          data-toggle="dropdown"
          href="#"
          role="button"
          aria-haspopup="true"
          aria-expanded="false"
          >Center</a
        >
        <div class="dropdown-menu">
          <a
            class="dropdown-item"
            id="center-list-tab"
            data-toggle="tab"
            href="#center-list"
            role="tab"
            aria-controls="center-list"
            aria-selected="false"
            >Center List</a
          >
          <a
            class="dropdown-item"
            id="center-create-tab"
            href="#center-list-create"
            data-toggle="tab"
            role="tab"
            aria-controls="center-list-create"
            aria-selected="false"
            @click="center.model.clearData()"
            >Create Center</a
          >
        </div>
      </li>
      <span class="badge badge-primary">2</span>
      <li
        class="nav-item dropdown"
        role="presentation"
        style="min-width: 150px"
      >
        <a
          class="nav-link dropdown-toggle ward-setting"
          data-toggle="dropdown"
          href="#"
          role="button"
          aria-haspopup="true"
          aria-expanded="false"
          >Ward</a
        >
        <div class="dropdown-menu">
          <a
            class="dropdown-item"
            id="ward-list-tab"
            data-toggle="tab"
            href="#ward-list"
            role="tab"
            aria-controls="ward-list"
            aria-selected="false"
            >Ward List</a
          >
          <a
            class="dropdown-item"
            id="ward-create-tab"
            href="#ward-list-create"
            data-toggle="tab"
            role="tab"
            aria-controls="ward-list-create"
            aria-selected="false"
            @click="ward.model.clearData()"
            >Create Ward</a
          >
        </div>
      </li>
      <span class="badge badge-primary">3</span>
      <li
        class="nav-item dropdown"
        role="presentation"
        style="min-width: 150px"
      >
        <a
          class="nav-link dropdown-toggle alms-round-setting"
          data-toggle="dropdown"
          href="#"
          role="button"
          aria-haspopup="true"
          aria-expanded="false"
          >Alms Round</a
        >
        <div class="dropdown-menu">
          <a
            class="dropdown-item"
            id="alms-round-list-tab"
            data-toggle="tab"
            href="#alms-round-list"
            role="tab"
            aria-controls="alms-round-list"
            aria-selected="false"
            >Alms Round List</a
          >
          <a
            class="dropdown-item"
            id="alms-round-create-tab"
            href="#alms-round-list-create"
            data-toggle="tab"
            role="tab"
            aria-controls="alms-round-list-create"
            aria-selected="false"
            @click="almsRound.model.clearData()"
            >Create Alms Round</a
          >
        </div>
      </li>
      <span class="badge badge-info">1</span>
      <li
        class="nav-item dropdown"
        role="presentation"
        style="min-width: 150px"
      >
        <a
          class="nav-link dropdown-toggle volunteer-job-setting"
          data-toggle="dropdown"
          href="#"
          role="button"
          aria-haspopup="true"
          aria-expanded="false"
          >Volunteer Job</a
        >
        <div class="dropdown-menu">
          <a
            class="dropdown-item"
            id="volunteer-job-list-tab"
            data-toggle="tab"
            href="#volunteer-job-list"
            role="tab"
            aria-controls="volunteer-job-list"
            aria-selected="false"
            >Job List</a
          >
          <a
            class="dropdown-item"
            id="volunteer-job-create-tab"
            href="#volunteer-job-list-create"
            data-toggle="tab"
            role="tab"
            aria-controls="volunteer-job-list-create"
            aria-selected="false"
            @click="volunteerJob.model.clearData()"
            >Create Job</a
          >
        </div>
      </li>
      <span class="badge badge-warning">1</span>
      <li
        class="nav-item dropdown"
        role="presentation"
        style="min-width: 150px"
      >
        <a
          class="nav-link dropdown-toggle item-type-setting"
          data-toggle="dropdown"
          href="#"
          role="button"
          aria-haspopup="true"
          aria-expanded="false"
          >Item Type</a
        >
        <div class="dropdown-menu">
          <a
            class="dropdown-item"
            id="item-type-tab"
            data-toggle="tab"
            href="#item-type-list"
            role="tab"
            aria-controls="item-type-list"
            aria-selected="false"
            >Item Type</a
          >
          <a
            class="dropdown-item"
            id="item-type-create-tab"
            href="#item-type-list-create"
            data-toggle="tab"
            role="tab"
            aria-controls="item-type-list-create"
            aria-selected="false"
            @click="itemType.model.clearData()"
            >Create Item Type</a
          >
        </div>
      </li>
      <span class="badge badge-warning">2</span>
      <li
        class="nav-item dropdown"
        role="presentation"
        style="min-width: 150px"
      >
        <a
          class="nav-link dropdown-toggle item-sub-type-setting"
          data-toggle="dropdown"
          href="#"
          role="button"
          aria-haspopup="true"
          aria-expanded="false"
          >Item Sub Type</a
        >
        <div class="dropdown-menu">
          <a
            class="dropdown-item"
            id="item-sub-type-tab"
            data-toggle="tab"
            href="#item-sub-type-list"
            role="tab"
            aria-controls="item-sub-type-list"
            aria-selected="false"
            >Item Sub Type</a
          >
          <a
            class="dropdown-item"
            id="item-sub-type-create-tab"
            href="#item-sub-type-list-create"
            data-toggle="tab"
            role="tab"
            aria-controls="item-sub-type-list-create"
            aria-selected="false"
            @click="itemSubType.model.clearData()"
            >Create Item Sub Type</a
          >
        </div>
      </li>
      <span class="badge badge-danger">1</span>
      <li
        class="nav-item dropdown"
        role="presentation"
        style="min-width: 150px"
      >
        <a
          class="nav-link dropdown-toggle unit-setting"
          data-toggle="dropdown"
          href="#"
          role="button"
          aria-haspopup="true"
          aria-expanded="false"
          >Unit</a
        >
        <div class="dropdown-menu">
          <a
            class="dropdown-item"
            id="unit-tab"
            data-toggle="tab"
            href="#unit-list"
            role="tab"
            aria-controls="unit-list"
            aria-selected="false"
            >Unit</a
          >
          <a
            class="dropdown-item"
            id="unit-create-tab"
            href="#unit-list-create"
            data-toggle="tab"
            role="tab"
            aria-controls="unit-list-create"
            aria-selected="false"
            @click="unit.model.clearData()"
            >Create Unit</a
          >
        </div>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <!-- start box -->
      <div
        class="tab-pane fade show"
        id="box-list"
        role="tabpanel"
        aria-labelledby="box-list-tab"
      >
        <table
          class="table table-hover table-dark"
          cellpadding="0"
          cellspacing="0"
        >
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Box Number</th>
              <th scope="col">Store</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in box.model.list.data" :key="item.id">
              <th scope="row">{{ index + 1 }}</th>
              <td style="max-width: 20px">{{ item.name }}</td>
              <td style="max-width: 20px">{{ item.box_number }}</td>
              <td style="max-width: 20px">
                {{ item.store ? item.store.name : "-" }}
              </td>
              <td style="max-width: 20px">
                <button
                  class="btn btn-outline-warning"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#edit-collapse-box-${item.id}`"
                  aria-expanded="false"
                  aria-controls="editCollapseExample"
                >
                  Edit
                </button>
                <div :id="`edit-collapse-box-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="box.model.editRecord(index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#edit-collapse-box-${item.id}`"
                    aria-expanded="false"
                    aria-controls="editCollapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
              <td style="max-width: 20px">
                <button
                  class="btn"
                  v-bind:class="{
                    'btn-outline-danger': item.deleted_at == null,
                    'btn-outline-success': item.deleted_at != null,
                  }"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#collapse-box-${item.id}`"
                  aria-expanded="false"
                  aria-controls="collapseExample"
                >
                  {{ item.deleted_at == null ? "Delete" : "Restore" }}
                </button>
                <div :id="`collapse-box-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="box.model.deleteBox(item.uuid, index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#collapse-box-${item.id}`"
                    aria-expanded="false"
                    aria-controls="collapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          :data="box.model.list"
          align="center"
          v-on:pagination-change-page="getBoxResult"
        ></pagination>
      </div>
      <div
        class="tab-pane fade show"
        id="box-list-create"
        role="tabpanel"
        aria-labelledby="box-list-create-tab"
      >
        <div class="col-md-6 card border border-success">
          <div class="card-body">
            <!-- start store select2 -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': box.validation.office_id_hasError,
                'was-validated':
                  box.validation.office_id_successMessage &&
                  !box.validation.office_id_hasError,
              }"
            >
              <label for="country-id">
                Select Store
                <span class="text-danger">*</span>
              </label>
              <select2
                placeholder="Type To Search Store..."
                :url="store.model.fetchListUrl"
                :value="box.model.store_id"
                @input="box.model.storeSelected($event)"
                :selected-option="box.model.store"
                v-bind:class="{
                  'is-invalid': box.validation.store_id_hasError,
                }"
              ></select2>

              <div class="invalid-feedback">
                {{ box.validation.store_id_errorMessage }}
              </div>
              <div class="valid-feedback" style="display: block">
                {{ box.validation.store_id_successMessage }}
              </div>
            </div>
            <!-- end office select2 -->

            <!-- start box name -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': box.validation.name_hasError,
                'was-validated':
                  box.validation.validation != null &&
                  !box.validation.name_hasError,
              }"
            >
              <label for="box_name">
                Box Name
                <span class="text-danger">*</span>
              </label>
              <input
                id="box_name"
                type="text"
                class="form-control"
                placeholder="Box Name"
                v-model="box.model.name"
                v-bind:class="{ 'is-invalid': box.validation.name_hasError }"
              />
              <div class="invalid-feedback">
                {{ box.validation.name_errorMessage }}
              </div>
              <div class="valid-feedback">
                {{ box.validation.name_successMessage }}
              </div>
            </div>
            <!-- end box name -->

            <!-- start box number -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': box.validation.box_number_hasError,
                'was-validated':
                  box.validation.box_number_successMessage &&
                  !box.validation.box_number_hasError,
              }"
            >
              <label for="box_number">
                Box Number
                <span class="text-danger">*</span>
              </label>
              <input
                id="box_number"
                type="text"
                class="form-control only-number"
                placeholder="Box Number"
                v-model="box.model.box_number"
                v-bind:class="{
                  'is-invalid': box.validation.box_number_hasError,
                }"
              />
              <div class="invalid-feedback">
                {{ box.validation.box_number_errorMessage }}
              </div>
              <div class="valid-feedback">
                {{ box.validation.box_number_successMessage }}
              </div>
            </div>
            <!-- end box number -->

            <button
              v-if="box.model.isEdit"
              @click="box.model.updateBox()"
              class="btn btn-success"
            >
              Update
            </button>
            <button
              v-if="box.model.isEdit"
              @click="box.model.goToList()"
              class="btn btn-default"
            >
              Cancel
            </button>
            <button v-else @click="box.model.saveBox()" class="btn btn-success">
              Create
            </button>
          </div>
        </div>
      </div>
      <!-- end box -->

      <!-- start item type -->
      <div
        class="tab-pane fade show"
        id="item-type-list"
        role="tabpanel"
        aria-labelledby="item-type-list-tab"
      >
        <table
          class="table table-hover table-dark"
          cellpadding="0"
          cellspacing="0"
        >
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(item, index) in itemType.model.list.data"
              :key="item.id"
            >
              <th scope="row">{{ index + 1 }}</th>
              <td style="max-width: 20px">{{ item.name }}</td>
              <td style="max-width: 20px">
                <button
                  class="btn btn-outline-warning"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#edit-collapse-item-type-${item.id}`"
                  aria-expanded="false"
                  aria-controls="editCollapseExample"
                >
                  Edit
                </button>
                <div
                  :id="`edit-collapse-item-type-${item.id}`"
                  class="collapse p-1"
                >
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="itemType.model.editRecord(index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#edit-collapse-item-type-${item.id}`"
                    aria-expanded="false"
                    aria-controls="editCollapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
              <td style="max-width: 20px">
                <button
                  class="btn"
                  v-bind:class="{
                    'btn-outline-danger': item.deleted_at == null,
                    'btn-outline-success': item.deleted_at != null,
                  }"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#collapse-item-type-${item.id}`"
                  aria-expanded="false"
                  aria-controls="collapseExample"
                >
                  {{ item.deleted_at == null ? "Delete" : "Restore" }}
                </button>
                <div :id="`collapse-item-type-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="itemType.model.deleteItemType(item.id, index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#collapse-item-type-${item.id}`"
                    aria-expanded="false"
                    aria-controls="collapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          :data="itemType.model.list"
          align="center"
          v-on:pagination-change-page="getItemTypeResult"
        ></pagination>
      </div>
      <div
        class="tab-pane fade show"
        id="item-type-list-create"
        role="tabpanel"
        aria-labelledby="item-type-list-create-tab"
      >
        <div class="col-md-6 card border border-success">
          <div class="card-body">
            <!-- start item type name -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': itemType.validation.name_hasError,
                'was-validated':
                  itemType.validation.validation != null &&
                  !itemType.validation.name_hasError,
              }"
            >
              <label for="item_type_name">
                Item Type Name
                <span class="text-danger">*</span>
              </label>
              <input
                id="item_type_name"
                type="text"
                class="form-control"
                placeholder="Item Type Name"
                v-model="itemType.model.name"
                v-bind:class="{
                  'is-invalid': itemType.validation.name_hasError,
                }"
              />
              <div class="invalid-feedback">
                {{ itemType.validation.name_errorMessage }}
              </div>
              <div class="valid-feedback">
                {{ itemType.validation.name_successMessage }}
              </div>
            </div>
            <!-- end item type name -->

            <button
              v-if="itemType.model.isEdit"
              @click="itemType.model.updateItemType()"
              class="btn btn-success"
            >
              Update
            </button>
            <button
              v-if="itemType.model.isEdit"
              @click="itemType.model.goToList()"
              class="btn btn-default"
            >
              Cancel
            </button>
            <button
              v-else
              @click="itemType.model.saveItemType()"
              class="btn btn-success"
            >
              Create
            </button>
          </div>
        </div>
      </div>
      <!-- end item type -->

      <!-- start item sub type -->
      <div
        class="tab-pane fade show"
        id="item-sub-type-list"
        role="tabpanel"
        aria-labelledby="item-sub-type-list-tab"
      >
        <table
          class="table table-hover table-dark"
          cellpadding="0"
          cellspacing="0"
        >
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Item Type</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(item, index) in itemSubType.model.list.data"
              :key="item.id"
            >
              <th scope="row">{{ index + 1 }}</th>
              <td style="max-width: 20px">{{ item.name }}</td>
              <td style="max-width: 20px">{{ item.item_type.name }}</td>
              <td style="max-width: 20px">
                <button
                  class="btn btn-outline-warning"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#edit-collapse-item-sub-type-${item.id}`"
                  aria-expanded="false"
                  aria-controls="editCollapseExample"
                >
                  Edit
                </button>
                <div
                  :id="`edit-collapse-item-sub-type-${item.id}`"
                  class="collapse p-1"
                >
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="itemSubType.model.editRecord(index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#edit-collapse-item-sub-type-${item.id}`"
                    aria-expanded="false"
                    aria-controls="editCollapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
              <td style="max-width: 20px">
                <button
                  class="btn"
                  v-bind:class="{
                    'btn-outline-danger': item.deleted_at == null,
                    'btn-outline-success': item.deleted_at != null,
                  }"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#collapse-item-sub-type-${item.id}`"
                  aria-expanded="false"
                  aria-controls="collapseExample"
                >
                  {{ item.deleted_at == null ? "Delete" : "Restore" }}
                </button>
                <div :id="`collapse-item-sub-type-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="itemSubType.model.deleteItemSubType(item.id, index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#collapse-item-sub-type-${item.id}`"
                    aria-expanded="false"
                    aria-controls="collapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          :data="itemSubType.model.list"
          align="center"
          v-on:pagination-change-page="getItemSubTypeResult"
        ></pagination>
      </div>
      <div
        class="tab-pane fade show"
        id="item-sub-type-list-create"
        role="tabpanel"
        aria-labelledby="item-type-list-create-tab"
      >
        <div class="col-md-6 card border border-success">
          <div class="card-body">

            <!-- start item type select2 -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': itemSubType.validation.item_type_id_hasError,
                'was-validated':
                  itemSubType.validation.item_type_id_successMessage &&
                  !itemSubType.validation.item_type_id_hasError,
              }"
            >
              <label for="country-id">
                Select Item Type
                <span class="text-danger">*</span>
              </label>
              <select2
                placeholder="Type To Search Item Type..."
                :url="itemType.model.fetchListUrl"
                :value="itemSubType.model.item_type_id"
                @input="itemSubType.model.itemTypeSelected($event)"
                :selected-option="itemSubType.model.center"
                v-bind:class="{
                  'is-invalid': itemSubType.validation.item_type_id_hasError,
                }"
              ></select2>

              <div class="invalid-feedback">
                {{ itemSubType.validation.item_type_id_errorMessage }}
              </div>
              <div class="valid-feedback" style="display: block">
                {{ itemSubType.validation.item_type_id_successMessage }}
              </div>
            </div>
            <!-- end item type select2 -->

            <!-- start item sub type name -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': itemSubType.validation.name_hasError,
                'was-validated':
                  itemSubType.validation.validation != null &&
                  !itemSubType.validation.name_hasError,
              }"
            >
              <label for="item_type_name">
                Item Sub Type Name
                <span class="text-danger">*</span>
              </label>
              <input
                id="item_sub_type_name"
                type="text"
                class="form-control"
                placeholder="Item Sub Type Name"
                v-model="itemSubType.model.name"
                v-bind:class="{
                  'is-invalid': itemSubType.validation.name_hasError,
                }"
              />
              <div class="invalid-feedback">
                {{ itemSubType.validation.name_errorMessage }}
              </div>
              <div class="valid-feedback">
                {{ itemSubType.validation.name_successMessage }}
              </div>
            </div>
            <!-- end item sub type name -->

            <button
              v-if="itemSubType.model.isEdit"
              @click="itemSubType.model.updateItemSubType()"
              class="btn btn-success"
            >
              Update
            </button>
            <button
              v-if="itemSubType.model.isEdit"
              @click="itemSubType.model.goToList()"
              class="btn btn-default"
            >
              Cancel
            </button>
            <button
              v-else
              @click="itemSubType.model.saveItemSubType()"
              class="btn btn-success"
            >
              Create
            </button>
          </div>
        </div>
      </div>
      <!-- end item sub type -->

      <!-- start store -->
      <div
        class="tab-pane fade show"
        id="store-list"
        role="tabpanel"
        aria-labelledby="store-list-tab"
      >
        <table
          class="table table-hover table-dark"
          cellpadding="0"
          cellspacing="0"
        >
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Store Number</th>
              <th scope="col">Office</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in store.model.list.data" :key="item.id">
              <th scope="row">{{ index + 1 }}</th>
              <td style="max-width: 20px">{{ item.name }}</td>
              <td style="max-width: 20px">{{ item.store_number }}</td>
              <td style="max-width: 20px">
                <i
                  aria-hidden="true"
                  v-if="item.office && item.office.is_open == 1"
                  class="material-icons green"
                  >check_circle</i
                >
                <i
                  aria-hidden="true"
                  v-else-if="item.office && item.office.is_open == 0"
                  class="material-icons red"
                  >cancel</i
                >
                {{ item.office ? item.office.name : "-" }}
              </td>
              <td style="max-width: 20px">
                <button
                  class="btn btn-outline-warning"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#edit-collapse-store-${item.id}`"
                  aria-expanded="false"
                  aria-controls="editCollapseExample"
                >
                  Edit
                </button>
                <div
                  :id="`edit-collapse-store-${item.id}`"
                  class="collapse p-1"
                >
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="store.model.editRecord(index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#edit-collapse-store-${item.id}`"
                    aria-expanded="false"
                    aria-controls="editCollapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
              <td style="max-width: 20px">
                <button
                  class="btn"
                  v-bind:class="{
                    'btn-outline-danger': item.deleted_at == null,
                    'btn-outline-success': item.deleted_at != null,
                  }"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#collapse-store-${item.id}`"
                  aria-expanded="false"
                  aria-controls="collapseExample"
                >
                  {{ item.deleted_at == null ? "Delete" : "Restore" }}
                </button>
                <div :id="`collapse-store-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="store.model.deleteStore(item.uuid, index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#collapse-store-${item.id}`"
                    aria-expanded="false"
                    aria-controls="collapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          :data="store.model.list"
          align="center"
          v-on:pagination-change-page="getStoreResult"
        ></pagination>
      </div>
      <div
        class="tab-pane fade show"
        id="store-list-create"
        role="tabpanel"
        aria-labelledby="store-list-create-tab"
      >
        <div class="col-md-6 card border border-success">
          <div class="card-body">
            <!-- start office select2 -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': store.validation.office_id_hasError,
                'was-validated':
                  store.validation.office_id_successMessage &&
                  !store.validation.office_id_hasError,
              }"
            >
              <label for="country-id">
                Select Office
                <span class="text-danger">*</span>
              </label>
              <select2
                placeholder="Type To Search Office..."
                :url="office.model.fetchListUrl"
                :value="store.model.office_id"
                @input="store.model.officeSelected($event)"
                :selected-option="store.model.office"
                v-bind:class="{
                  'is-invalid': store.validation.office_id_hasError,
                }"
              ></select2>

              <div class="invalid-feedback">
                {{ store.validation.office_id_errorMessage }}
              </div>
              <div class="valid-feedback" style="display: block">
                {{ store.validation.office_id_successMessage }}
              </div>
            </div>
            <!-- end office select2 -->

            <!-- start store name -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': store.validation.name_hasError,
                'was-validated':
                  store.validation.validation != null &&
                  !store.validation.name_hasError,
              }"
            >
              <label for="store_name">
                Store Name
                <span class="text-danger">*</span>
              </label>
              <input
                id="store_name"
                type="text"
                class="form-control"
                placeholder="store Name"
                v-model="store.model.name"
                v-bind:class="{ 'is-invalid': store.validation.name_hasError }"
              />
              <div class="invalid-feedback">
                {{ store.validation.name_errorMessage }}
              </div>
              <div class="valid-feedback">
                {{ store.validation.name_successMessage }}
              </div>
            </div>
            <!-- end store name -->

            <!-- start store number -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': store.validation.store_number_hasError,
                'was-validated':
                  store.validation.store_number_successMessage &&
                  !store.validation.store_number_hasError,
              }"
            >
              <label for="store_number">
                Store Number
                <span class="text-danger">*</span>
              </label>
              <input
                id="store_number"
                type="text"
                class="form-control only-number"
                placeholder="Store Number"
                v-model="store.model.store_number"
                v-bind:class="{
                  'is-invalid': store.validation.store_number_hasError,
                }"
              />
              <div class="invalid-feedback">
                {{ store.validation.store_number_errorMessage }}
              </div>
              <div class="valid-feedback">
                {{ store.validation.store_number_successMessage }}
              </div>
            </div>
            <!-- end store number -->

            <button
              v-if="store.model.isEdit"
              @click="store.model.updateStore()"
              class="btn btn-success"
            >
              Update
            </button>
            <button
              v-if="store.model.isEdit"
              @click="store.model.goToList()"
              class="btn btn-default"
            >
              Cancel
            </button>
            <button
              v-else
              @click="store.model.saveStore()"
              class="btn btn-success"
            >
              Create
            </button>
          </div>
        </div>
      </div>
      <!-- end store -->

      <!-- start office -->
      <div
        class="tab-pane fade show active"
        id="office-list"
        role="tabpanel"
        aria-labelledby="office-list-tab"
      >
        <table
          class="table table-hover table-dark"
          cellpadding="0"
          cellspacing="0"
        >
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Open</th>
              <th scope="col">Center</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in office.model.list.data" :key="item.id">
              <th scope="row">{{ index + 1 }}</th>
              <td style="max-width: 20px">{{ item.name }}</td>
              <td style="max-width: 20px">
                <i
                  aria-hidden="true"
                  v-if="item.is_open == 1"
                  class="material-icons green"
                  >check_circle</i
                >
                <i aria-hidden="true" v-else class="material-icons red"
                  >cancel</i
                >
              </td>
              <td style="max-width: 20px">
                <i
                  aria-hidden="true"
                  v-if="item.center ? item.center.is_available == 1 : ''"
                  class="material-icons green"
                  >check_circle</i
                >
                <i
                  aria-hidden="true"
                  v-else-if="item.center ? item.center.is_available == 0 : ''"
                  class="material-icons red"
                  >cancel</i
                >
                {{ item.center ? item.center.name : "-" }}
              </td>
              <td style="max-width: 20px">
                <button
                  class="btn btn-outline-warning"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#edit-collapse-office-${item.id}`"
                  aria-expanded="false"
                  aria-controls="editCollapseExample"
                >
                  Edit
                </button>
                <div
                  :id="`edit-collapse-office-${item.id}`"
                  class="collapse p-1"
                >
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="office.model.editRecord(index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#edit-collapse-office-${item.id}`"
                    aria-expanded="false"
                    aria-controls="editCollapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
              <td style="max-width: 20px">
                <button
                  class="btn"
                  v-bind:class="{
                    'btn-outline-danger': item.deleted_at == null,
                    'btn-outline-success': item.deleted_at != null,
                  }"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#collapse-office-${item.id}`"
                  aria-expanded="false"
                  aria-controls="collapseExample"
                >
                  {{ item.deleted_at == null ? "Delete" : "Restore" }}
                </button>
                <div :id="`collapse-office-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="office.model.deleteOffice(item.uuid, index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#collapse-office-${item.id}`"
                    aria-expanded="false"
                    aria-controls="collapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          :data="office.model.list"
          align="center"
          v-on:pagination-change-page="getOfficeResult"
        ></pagination>
      </div>
      <div
        class="tab-pane fade show"
        id="office-list-create"
        role="tabpanel"
        aria-labelledby="office-list-create-tab"
      >
        <div class="col-md-6 card border border-success">
          <div class="card-body">
            <!-- start center select2 -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': office.validation.center_id_hasError,
                'was-validated':
                  office.validation.center_id_successMessage &&
                  !office.validation.center_id_hasError,
              }"
            >
              <label for="country-id">
                Select Center
                <span class="text-danger">*</span>
              </label>
              <select2
                placeholder="Type To Search Center..."
                :url="center.model.fetchListUrl"
                :value="office.model.center_id"
                @input="office.model.centerSelected($event)"
                :selected-option="office.model.center"
                v-bind:class="{
                  'is-invalid': office.validation.center_id_hasError,
                }"
              ></select2>

              <div class="invalid-feedback">
                {{ office.validation.center_id_errorMessage }}
              </div>
              <div class="valid-feedback" style="display: block">
                {{ office.validation.center_id_successMessage }}
              </div>
            </div>
            <!-- end center select2 -->

            <!-- start office name -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': office.validation.name_hasError,
                'was-validated':
                  office.validation.validation != null &&
                  !office.validation.name_hasError,
              }"
            >
              <label for="office_name">
                Office Name
                <span class="text-danger">*</span>
              </label>
              <input
                id="office_name"
                type="text"
                class="form-control"
                placeholder="office Name"
                v-model="office.model.name"
                v-bind:class="{ 'is-invalid': office.validation.name_hasError }"
              />
              <div class="invalid-feedback">
                {{ office.validation.name_errorMessage }}
              </div>
              <div class="valid-feedback">
                {{ office.validation.name_successMessage }}
              </div>
            </div>
            <!-- end office name -->

            <!-- start office address -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': office.validation.address_hasError,
                'was-validated':
                  office.validation.validation != null &&
                  !office.validation.address_hasError,
              }"
            >
              <label for="office_address">
                Office Address
                <span class="text-danger">*</span>
              </label>
              <input
                id="office_address"
                type="text"
                class="form-control"
                placeholder="Office Address"
                v-model="office.model.address"
                v-bind:class="{
                  'is-invalid': office.validation.address_hasError,
                }"
              />
              <div class="invalid-feedback">
                {{ office.validation.address_errorMessage }}
              </div>
              <div class="valid-feedback">
                {{ office.validation.address_successMessage }}
              </div>
            </div>
            <!-- end office address -->

            <!-- start office is_open -->
            <div class="col-sm-offset-2 col-sm-10">
              <div
                class="checkbox"
                v-bind:class="{
                  'has-error': office.validation.is_open_hasError,
                }"
              >
                <input
                  type="checkbox"
                  id="office_is_open"
                  value="1"
                  v-model="office.model.is_open"
                  true-value="1"
                  false-value="0"
                  v-bind:class="{
                    'is-invalid': office.validation.is_open_hasError,
                  }"
                />
                <label for="office_is_open">
                  Is Open
                  <span class="text-danger">*</span>
                </label>
                <div class="invalid-feedback">
                  {{ office.validation.is_open_errorMessage }}
                </div>
              </div>
            </div>
            <!-- end office is_open -->
            <button
              v-if="office.model.isEdit"
              @click="office.model.updateOffice()"
              class="btn btn-success"
            >
              Update
            </button>
            <button
              v-if="office.model.isEdit"
              @click="office.model.goToList()"
              class="btn btn-default"
            >
              Cancel
            </button>
            <button
              v-else
              @click="office.model.saveOffice()"
              class="btn btn-success"
            >
              Create
            </button>
          </div>
        </div>
      </div>
      <!-- end office -->

      <!-- start country -->
      <div
        class="tab-pane fade"
        id="country-list-create"
        role="tabpanel"
        aria-labelledby="country-list-create-tab"
      >
        <div class="col-md-6 card border border-success">
          <div class="card-body">
            <!-- start country name -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': country.validation.name_hasError,
                'was-validated':
                  country.validation.validation != null &&
                  !country.validation.name_hasError,
              }"
            >
              <label for="about_item">
                Country Name
                <span class="text-danger">*</span>
              </label>
              <input
                id="country_name"
                type="text"
                class="form-control"
                placeholder="Country Name"
                v-model="country.model.name"
                v-bind:class="{
                  'is-invalid': country.validation.name_hasError,
                }"
              />
              <div class="invalid-feedback">
                {{ country.validation.name_errorMessage }}
              </div>
              <div class="valid-feedback">
                {{ country.validation.name_successMessage }}
              </div>
            </div>
            <!-- end country name -->

            <!-- start country is_available -->
            <div class="col-sm-offset-2 col-sm-10">
              <div
                class="checkbox"
                v-bind:class="{
                  'has-error': country.validation.is_available_hasError,
                }"
              >
                <input
                  type="checkbox"
                  id="country_is_available"
                  value="1"
                  v-model="country.model.is_available"
                  true-value="1"
                  false-value="0"
                  v-bind:class="{
                    'is-invalid': country.validation.is_available_hasError,
                  }"
                />
                <label for="country_is_available">
                  Available
                  <span class="text-danger">*</span>
                </label>
                <div class="invalid-feedback">
                  {{ country.validation.is_available_errorMessage }}
                </div>
              </div>
            </div>
            <!-- end city is_available -->
            <button
              v-if="country.model.isEdit"
              @click="country.model.updateCountry()"
              class="btn btn-success"
            >
              Update
            </button>
            <button
              v-if="country.model.isEdit"
              @click="country.model.goToList('country-list')"
              class="btn btn-default"
            >
              Cancel
            </button>
            <button
              v-else
              @click="country.model.saveCountry()"
              class="btn btn-success"
            >
              Create
            </button>
          </div>
        </div>
      </div>
      <div
        class="tab-pane fade"
        id="country-list"
        role="tabpanel"
        aria-labelledby="country-list-tab"
      >
        <table
          class="table table-hover table-dark"
          cellpadding="0"
          cellspacing="0"
        >
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Is Available</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in country.model.list.data" :key="item.id">
              <th scope="row">{{ index + 1 }}</th>
              <td style="max-width: 20px">{{ item.name }}</td>
              <td style="max-width: 20px">
                <i
                  aria-hidden="true"
                  v-if="item.is_available == 1"
                  class="material-icons green"
                  >check_circle</i
                >
                <i aria-hidden="true" v-else class="material-icons red"
                  >cancel</i
                >
              </td>
              <td style="max-width: 20px">
                <button
                  class="btn btn-outline-warning"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#edit-collapse-country-${item.id}`"
                  aria-expanded="false"
                  aria-controls="editCollapseExample"
                >
                  Edit
                </button>
                <div
                  :id="`edit-collapse-country-${item.id}`"
                  class="collapse p-1"
                >
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="country.model.editRecord(index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#edit-collapse-country-${item.id}`"
                    aria-expanded="false"
                    aria-controls="editCollapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
              <td style="max-width: 20px">
                <button
                  class="btn"
                  v-bind:class="{
                    'btn-outline-danger': item.deleted_at == null,
                    'btn-outline-success': item.deleted_at != null,
                  }"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#collapse-country-${item.id}`"
                  aria-expanded="false"
                  aria-controls="collapseExample"
                >
                  {{ item.deleted_at == null ? "Delete" : "Restore" }}
                </button>
                <div :id="`collapse-country-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="country.model.deleteCountry(item.id, index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#collapse-country-${item.id}`"
                    aria-expanded="false"
                    aria-controls="collapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          :data="country.model.list"
          align="center"
          v-on:pagination-change-page="getCountryResult"
        ></pagination>
      </div>
      <!-- end country -->

      <!-- start state region -->
      <div
        class="tab-pane fade"
        id="state-region-list-create"
        role="tabpanel"
        aria-labelledby="state-region-create-tab"
      >
        <div class="col-md-6 card border border-success">
          <div class="card-body">
            <!-- start country select2 -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': stateRegion.validation.country_id_hasError,
                'was-validated':
                  stateRegion.validation.country_id_successMessage &&
                  !stateRegion.validation.country_id_hasError,
              }"
            >
              <label for="country-id">
                Select Country
                <span class="text-danger">*</span>
              </label>
              <select2
                placeholder="Type To Search Country..."
                :url="country.model.fetchListUrl"
                :value="stateRegion.model.country_id"
                @input="stateRegion.model.countrySelected($event)"
                :selected-option="stateRegion.model.country"
                v-bind:class="{
                  'is-invalid': stateRegion.validation.country_id_hasError,
                }"
              ></select2>

              <div class="invalid-feedback">
                {{ stateRegion.validation.country_id_errorMessage }}
              </div>
              <div class="valid-feedback" style="display: block">
                {{ stateRegion.validation.country_id_successMessage }}
              </div>
            </div>
            <!-- end country select2 -->

            <!-- start state region name -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': stateRegion.validation.name_hasError,
                'was-validated':
                  stateRegion.validation.name_successMessage &&
                  !stateRegion.validation.name_hasError,
              }"
            >
              <label for="about_item">
                State Or Region Name
                <span class="text-danger">*</span>
              </label>
              <input
                id="state_region_name"
                type="text"
                class="form-control"
                placeholder="State Or Region Name"
                v-model="stateRegion.model.name"
                v-bind:class="{
                  'is-invalid': stateRegion.validation.name_hasError,
                }"
              />
              <div class="invalid-feedback">
                {{ stateRegion.validation.name_errorMessage }}
              </div>
              <div class="valid-feedback">
                {{ stateRegion.validation.name_successMessage }}
              </div>
            </div>
            <!-- end state region name -->

            <!-- start state region code -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': stateRegion.validation.code_hasError,
                'was-validated':
                  stateRegion.validation.code_successMessage &&
                  !stateRegion.validation.code_hasError,
              }"
            >
              <label for="about_item">
                State Or Region Code
                <span class="text-danger">*</span>
              </label>
              <input
                id="state_region_code"
                type="text"
                class="form-control only-number"
                placeholder="State Or Region Code"
                v-model="stateRegion.model.code"
                v-bind:class="{
                  'is-invalid': stateRegion.validation.code_hasError,
                }"
              />
              <div class="invalid-feedback">
                {{ stateRegion.validation.code_errorMessage }}
              </div>
              <div class="valid-feedback">
                {{ stateRegion.validation.code_successMessage }}
              </div>
            </div>
            <!-- end state region code -->

            <!-- start state region is_available -->
            <div class="col-sm-offset-2 col-sm-10">
              <div
                class="checkbox"
                v-bind:class="{
                  'has-error': stateRegion.validation.is_available_hasError,
                }"
              >
                <input
                  type="checkbox"
                  id="state_region_is_available"
                  value="1"
                  v-model="stateRegion.model.is_available"
                  true-value="1"
                  false-value="0"
                  v-bind:class="{
                    'is-invalid': stateRegion.validation.is_available_hasError,
                  }"
                />
                <label for="state_region_is_available">
                  Is Available
                  <span class="text-danger">*</span>
                </label>
                <div class="invalid-feedback">
                  {{ stateRegion.validation.is_available_errorMessage }}
                </div>
              </div>
            </div>
            <!-- end city is_available -->
            <button
              v-if="stateRegion.model.isEdit"
              @click="stateRegion.model.updateStateRegion()"
              class="btn btn-success"
            >
              Update
            </button>
            <button
              v-if="stateRegion.model.isEdit"
              @click="stateRegion.model.goToList()"
              class="btn btn-default"
            >
              Cancel
            </button>
            <button
              v-else
              @click="stateRegion.model.saveStateRegion()"
              class="btn btn-success"
            >
              Create
            </button>
          </div>
        </div>
      </div>
      <div
        class="tab-pane fade"
        id="state-region-list"
        role="tabpanel"
        aria-labelledby="state-region-list-tab"
      >
        <table
          class="table table-hover table-dark"
          cellpadding="0"
          cellspacing="0"
        >
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Available</th>
              <th scope="col">Country</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(item, index) in stateRegion.model.list.data"
              :key="item.id"
            >
              <th scope="row">{{ index + 1 }}</th>
              <td style="max-width: 20px">{{ item.name }}</td>
              <td style="max-width: 20px">
                <i
                  aria-hidden="true"
                  v-if="item.is_available == 1"
                  class="material-icons green"
                  >check_circle</i
                >
                <i aria-hidden="true" v-else class="material-icons red"
                  >cancel</i
                >
              </td>
              <td>
                <i
                  aria-hidden="true"
                  v-if="item.country ? item.country.is_available == 1 : ''"
                  class="material-icons green"
                  >check_circle</i
                >
                <i
                  aria-hidden="true"
                  v-else-if="item.country ? item.country.is_available == 0 : ''"
                  class="material-icons red"
                  >cancel</i
                >
                {{ item.country ? item.country.name : "-" }}
              </td>
              <td style="max-width: 20px">
                <button
                  class="btn btn-outline-warning"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#edit-collapse-state-region-${item.id}`"
                  aria-expanded="false"
                  aria-controls="editCollapseExample"
                >
                  Edit
                </button>
                <div
                  :id="`edit-collapse-state-region-${item.id}`"
                  class="collapse p-1"
                >
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="stateRegion.model.editRecord(index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#edit-collapse-state-region-${item.id}`"
                    aria-expanded="false"
                    aria-controls="editCollapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
              <td style="max-width: 20px">
                <button
                  class="btn"
                  v-bind:class="{
                    'btn-outline-danger': item.deleted_at == null,
                    'btn-outline-success': item.deleted_at != null,
                  }"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#collapse-state-region-${item.id}`"
                  aria-expanded="false"
                  aria-controls="collapseExample"
                >
                  {{ item.deleted_at == null ? "Delete" : "Restore" }}
                </button>
                <div
                  :id="`collapse-state-region-${item.id}`"
                  class="collapse p-1"
                >
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="stateRegion.model.deleteStateRegion(item.id, index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#collapse-state-region-${item.id}`"
                    aria-expanded="false"
                    aria-controls="collapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          :data="stateRegion.model.list"
          align="center"
          v-on:pagination-change-page="getStateRegionResult"
        ></pagination>
      </div>
      <!-- end state region -->

      <!-- start city -->
      <div
        class="tab-pane fade row"
        id="city-list-create"
        role="tabpanel"
        aria-labelledby="city-create-tab"
      >
        <div class="col-md-6 card border border-success">
          <div class="card-body">
            <!-- start state region select2 -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': city.validation.state_region_id_hasError,
                'was-validated':
                  city.validation.state_region_id_successMessage &&
                  !city.validation.state_region_id_hasError,
              }"
            >
              <label for="country-id">
                Select State Region
                <span class="text-danger">*</span>
              </label>
              <select2
                placeholder="Type To Search State Region..."
                :url="stateRegion.model.fetchListUrl"
                :value="city.model.state_region_id"
                @input="city.model.stateRegionSelected($event)"
                :selected-option="city.model.stateRegion"
                v-bind:class="{
                  'is-invalid': city.validation.state_region_id_hasError,
                }"
              ></select2>

              <div class="invalid-feedback">
                {{ city.validation.state_region_id_errorMessage }}
              </div>
              <div class="valid-feedback" style="display: block">
                {{ city.validation.state_region_id_successMessage }}
              </div>
            </div>
            <!-- end state region select2 -->

            <!-- start city name -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': city.validation.name_hasError,
                'was-validated':
                  city.validation.validation != null &&
                  !city.validation.name_hasError,
              }"
            >
              <label for="about_item">
                City Name
                <span class="text-danger">*</span>
              </label>
              <input
                id="city_name"
                type="text"
                class="form-control"
                placeholder="City Name"
                v-model="city.model.name"
                v-bind:class="{ 'is-invalid': city.validation.name_hasError }"
              />
              <div class="invalid-feedback">
                {{ city.validation.name_errorMessage }}
              </div>
              <div class="valid-feedback">
                {{ city.validation.name_successMessage }}
              </div>
            </div>
            <!-- end city name -->

            <!-- start city is_available -->
            <div class="col-sm-offset-2 col-sm-10">
              <div
                class="checkbox"
                v-bind:class="{
                  'has-error': city.validation.is_available_hasError,
                }"
              >
                <input
                  type="checkbox"
                  id="city_is_available"
                  value="1"
                  v-model="city.model.is_available"
                  true-value="1"
                  false-value="0"
                  v-bind:class="{
                    'is-invalid': city.validation.is_available_hasError,
                  }"
                />
                <label for="city_is_available">
                  Is Available
                  <span class="text-danger">*</span>
                </label>
                <div class="invalid-feedback">
                  {{ city.validation.is_available_errorMessage }}
                </div>
              </div>
            </div>
            <!-- end city is_available -->
            <button
              v-if="city.model.isEdit"
              @click="city.model.updateCity()"
              class="btn btn-success"
            >
              Update
            </button>
            <button
              v-if="city.model.isEdit"
              @click="city.model.goToList('city-list')"
              class="btn btn-default"
            >
              Cancel
            </button>
            <button
              v-else
              @click="city.model.saveCity()"
              class="btn btn-success"
            >
              Create
            </button>
          </div>
        </div>
      </div>
      <div
        class="tab-pane fade"
        id="city-list"
        role="tabpanel"
        aria-labelledby="city-list-tab"
      >
        <table
          class="table table-hover table-dark"
          cellpadding="0"
          cellspacing="0"
        >
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Available</th>
              <th scope="col">State Or Region</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in city.model.list.data" :key="item.id">
              <th scope="row">{{ index + 1 }}</th>
              <td style="max-width: 20px">{{ item.name }}</td>
              <td style="max-width: 20px">
                <i
                  aria-hidden="true"
                  v-if="item.is_available == 1"
                  class="material-icons green"
                  >check_circle</i
                >
                <i aria-hidden="true" v-else class="material-icons red"
                  >cancel</i
                >
              </td>
              <td style="max-width: 20px">
                <i
                  aria-hidden="true"
                  v-if="
                    item.stateRegion ? item.stateRegion.is_available == 1 : ''
                  "
                  class="material-icons green"
                  >check_circle</i
                >
                <i
                  aria-hidden="true"
                  v-else-if="
                    item.stateRegion ? item.stateRegion.is_available == 0 : ''
                  "
                  class="material-icons red"
                  >cancel</i
                >
                {{ item.stateRegion ? item.stateRegion.name : "-" }}
              </td>
              <td style="max-width: 20px">
                <button
                  class="btn btn-outline-warning"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#edit-collapse-${item.id}`"
                  aria-expanded="false"
                  aria-controls="editCollapseExample"
                >
                  Edit
                </button>
                <div :id="`edit-collapse-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="city.model.editRecord(index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#edit-collapse-${item.id}`"
                    aria-expanded="false"
                    aria-controls="editCollapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
              <td style="max-width: 20px">
                <button
                  class="btn"
                  v-bind:class="{
                    'btn-outline-danger': item.deleted_at == null,
                    'btn-outline-success': item.deleted_at != null,
                  }"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#collapse-city-${item.id}`"
                  aria-expanded="false"
                  aria-controls="collapseExample"
                >
                  {{ item.deleted_at == null ? "Delete" : "Restore" }}
                </button>
                <div :id="`collapse-city-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="city.model.deleteCity(item.id, index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#collapse-city-${item.id}`"
                    aria-expanded="false"
                    aria-controls="collapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          :data="city.model.list"
          align="center"
          v-on:pagination-change-page="getCityResult"
        ></pagination>
      </div>
      <!-- end city -->

      <!-- start center -->
      <div
        class="tab-pane fade row"
        id="center-list-create"
        role="tabpanel"
        aria-labelledby="center-create-tab"
      >
        <div class="col-md-6 card border border-success">
          <div class="card-body">
            <!-- start city select2 -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': center.validation.city_id_hasError,
                'was-validated':
                  center.validation.city_id_successMessage &&
                  !center.validation.city_id_hasError,
              }"
            >
              <label for="country-id">
                Select City
                <span class="text-danger">*</span>
              </label>
              <select2
                placeholder="Type To Search State Region..."
                :url="city.model.fetchListUrl"
                :value="center.model.city_id"
                @input="center.model.citySelected($event)"
                :selected-option="center.model.city"
                v-bind:class="{
                  'is-invalid': center.validation.city_id_hasError,
                }"
              ></select2>

              <div class="invalid-feedback">
                {{ center.validation.city_id_errorMessage }}
              </div>
              <div class="valid-feedback" style="display: block">
                {{ center.validation.city_id_successMessage }}
              </div>
            </div>
            <!-- end city select2 -->

            <!-- start center name -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': center.validation.name_hasError,
                'was-validated':
                  center.validation.validation != null &&
                  !center.validation.name_hasError,
              }"
            >
              <label for="about_item">
                Center Name
                <span class="text-danger">*</span>
              </label>
              <input
                id="center_name"
                type="text"
                class="form-control"
                placeholder="Center Name"
                v-model="center.model.name"
                v-bind:class="{ 'is-invalid': center.validation.name_hasError }"
              />
              <div class="invalid-feedback">
                {{ center.validation.name_errorMessage }}
              </div>
              <div class="valid-feedback">
                {{ center.validation.name_successMessage }}
              </div>
            </div>
            <!-- end center name -->

            <!-- start center is_available -->
            <div class="col-sm-offset-2 col-sm-10">
              <div
                class="checkbox"
                v-bind:class="{
                  'has-error': center.validation.is_available_hasError,
                }"
              >
                <input
                  type="checkbox"
                  id="center_is_available"
                  value="1"
                  v-model="center.model.is_available"
                  true-value="1"
                  false-value="0"
                  v-bind:class="{
                    'is-invalid': center.validation.is_available_hasError,
                  }"
                />
                <label for="center_is_available">
                  Is Available
                  <span class="text-danger">*</span>
                </label>
                <div class="invalid-feedback">
                  {{ center.validation.is_available_errorMessage }}
                </div>
              </div>
            </div>
            <!-- end center is_available -->
            <button
              v-if="center.model.isEdit"
              @click="center.model.updateCenter()"
              class="btn btn-success"
            >
              Update
            </button>
            <button
              v-if="center.model.isEdit"
              @click="center.model.goToList('center-list')"
              class="btn btn-default"
            >
              Cancel
            </button>
            <button
              v-else
              @click="center.model.saveCenter()"
              class="btn btn-success"
            >
              Create
            </button>
          </div>
        </div>
      </div>
      <div
        class="tab-pane fade"
        id="center-list"
        role="tabpanel"
        aria-labelledby="center-list-tab"
      >
        <table
          class="table table-hover table-dark"
          cellpadding="0"
          cellspacing="0"
        >
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Available</th>
              <th scope="col">City</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in center.model.list.data" :key="item.id">
              <th scope="row">{{ index + 1 }}</th>
              <td style="max-width: 20px">{{ item.name }}</td>
              <td style="max-width: 20px">
                <i
                  aria-hidden="true"
                  v-if="item.is_available == 1"
                  class="material-icons green"
                  >check_circle</i
                >
                <i aria-hidden="true" v-else class="material-icons red"
                  >cancel</i
                >
              </td>
              <td style="max-width: 20px">
                <i
                  aria-hidden="true"
                  v-if="item.city ? item.city.is_available == 1 : ''"
                  class="material-icons green"
                  >check_circle</i
                >
                <i
                  aria-hidden="true"
                  v-else-if="item.city ? item.city.is_available == 0 : ''"
                  class="material-icons red"
                  >cancel</i
                >
                {{ item.city ? item.city.name : "-" }}
              </td>
              <td style="max-width: 20px">
                <button
                  class="btn btn-outline-warning"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#edit-collapse-center-${item.id}`"
                  aria-expanded="false"
                  aria-controls="editCollapseExample"
                >
                  Edit
                </button>
                <div :id="`edit-collapse-center-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="center.model.editRecord(index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#edit-collapse-center-${item.id}`"
                    aria-expanded="false"
                    aria-controls="editCollapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
              <td style="max-width: 20px">
                <button
                  class="btn"
                  v-bind:class="{
                    'btn-outline-danger': item.deleted_at == null,
                    'btn-outline-success': item.deleted_at != null,
                  }"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#collapse-center-${item.id}`"
                  aria-expanded="false"
                  aria-controls="collapseExample"
                >
                  {{ item.deleted_at == null ? "Delete" : "Restore" }}
                </button>
                <div :id="`collapse-center-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="center.model.deleteCenter(item.id, index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#collapse-center-${item.id}`"
                    aria-expanded="false"
                    aria-controls="collapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          :data="center.model.list"
          align="center"
          v-on:pagination-change-page="getCenterResult"
        ></pagination>
      </div>
      <!-- end center -->

      <!-- start ward -->
      <div
        class="tab-pane fade row"
        id="ward-list-create"
        role="tabpanel"
        aria-labelledby="ward-create-tab"
      >
        <div class="col-md-6 card border border-success">
          <div class="card-body">
            <!-- start center select2 -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': ward.validation.center_id_hasError,
                'was-validated':
                  ward.validation.center_id_successMessage &&
                  !ward.validation.center_id_hasError,
              }"
            >
              <label for="country-id">
                Select Center
                <span class="text-danger">*</span>
              </label>
              <select2
                placeholder="Type To Search Center..."
                :url="center.model.fetchListUrl"
                :value="ward.model.center_id"
                @input="ward.model.centerSelected($event)"
                :selected-option="ward.model.center"
                v-bind:class="{
                  'is-invalid': ward.validation.center_id_hasError,
                }"
              ></select2>

              <div class="invalid-feedback">
                {{ ward.validation.center_id_errorMessage }}
              </div>
              <div class="valid-feedback" style="display: block">
                {{ ward.validation.center_id_successMessage }}
              </div>
            </div>
            <!-- end center select2 -->

            <!-- start ward name -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': ward.validation.name_hasError,
                'was-validated':
                  ward.validation.validation != null &&
                  !ward.validation.name_hasError,
              }"
            >
              <label for="about_item">
                Ward Name
                <span class="text-danger">*</span>
              </label>
              <input
                id="ward_name"
                type="text"
                class="form-control"
                placeholder="Ward Name"
                v-model="ward.model.name"
                v-bind:class="{ 'is-invalid': ward.validation.name_hasError }"
              />
              <div class="invalid-feedback">
                {{ ward.validation.name_errorMessage }}
              </div>
              <div class="valid-feedback">
                {{ ward.validation.name_successMessage }}
              </div>
            </div>
            <!-- end ward name -->

            <!-- start ward is_available -->
            <div class="col-sm-offset-2 col-sm-10">
              <div
                class="checkbox"
                v-bind:class="{
                  'has-error': ward.validation.is_available_hasError,
                }"
              >
                <input
                  type="checkbox"
                  id="ward_is_available"
                  value="1"
                  v-model="ward.model.is_available"
                  true-value="1"
                  false-value="0"
                  v-bind:class="{
                    'is-invalid': ward.validation.is_available_hasError,
                  }"
                />
                <label for="ward_is_available">
                  Is Available
                  <span class="text-danger">*</span>
                </label>
                <div class="invalid-feedback">
                  {{ ward.validation.is_available_errorMessage }}
                </div>
              </div>
            </div>
            <!-- end ward is_available -->
            <button
              v-if="ward.model.isEdit"
              @click="ward.model.updateWard()"
              class="btn btn-success"
            >
              Update
            </button>
            <button
              v-if="ward.model.isEdit"
              @click="ward.model.goToList('ward-list')"
              class="btn btn-default"
            >
              Cancel
            </button>
            <button
              v-else
              @click="ward.model.saveWard()"
              class="btn btn-success"
            >
              Create
            </button>
          </div>
        </div>
      </div>
      <div
        class="tab-pane fade"
        id="ward-list"
        role="tabpanel"
        aria-labelledby="ward-list-tab"
      >
        <table
          class="table table-hover table-dark"
          cellpadding="0"
          cellspacing="0"
        >
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Available</th>
              <th scope="col">Center</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in ward.model.list.data" :key="item.id">
              <th scope="row">{{ index + 1 }}</th>
              <td style="max-width: 20px">{{ item.name }}</td>
              <td style="max-width: 20px">
                <i
                  aria-hidden="true"
                  v-if="item.is_available == 1"
                  class="material-icons green"
                  >check_circle</i
                >
                <i aria-hidden="true" v-else class="material-icons red"
                  >cancel</i
                >
              </td>
              <td style="max-width: 20px">
                <i
                  aria-hidden="true"
                  v-if="item.center ? item.center.is_available == 1 : ''"
                  class="material-icons green"
                  >check_circle</i
                >
                <i
                  aria-hidden="true"
                  v-else-if="item.center ? item.center.is_available == 0 : ''"
                  class="material-icons red"
                  >cancel</i
                >
                {{ item.center ? item.center.name : "-" }}
              </td>
              <td style="max-width: 20px">
                <button
                  class="btn btn-outline-warning"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#edit-collapse-ward-${item.id}`"
                  aria-expanded="false"
                  aria-controls="editCollapseExample"
                >
                  Edit
                </button>
                <div :id="`edit-collapse-ward-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="ward.model.editRecord(index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#edit-collapse-ward-${item.id}`"
                    aria-expanded="false"
                    aria-controls="editCollapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
              <td style="max-width: 20px">
                <button
                  class="btn"
                  v-bind:class="{
                    'btn-outline-danger': item.deleted_at == null,
                    'btn-outline-success': item.deleted_at != null,
                  }"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#collapse-ward-${item.id}`"
                  aria-expanded="false"
                  aria-controls="collapseExample"
                >
                  {{ item.deleted_at == null ? "Delete" : "Restore" }}
                </button>
                <div :id="`collapse-ward-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="ward.model.deleteWard(item.id, index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#collapse-ward-${item.id}`"
                    aria-expanded="false"
                    aria-controls="collapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          :data="ward.model.list"
          align="center"
          v-on:pagination-change-page="getWardResult"
        ></pagination>
      </div>
      <!-- end ward -->

      <!-- start alms round -->
      <div
        class="tab-pane fade row"
        id="alms-round-list-create"
        role="tabpanel"
        aria-labelledby="alms-round-create-tab"
      >
        <div class="col-md-6 card border border-success">
          <div class="card-body">
            <!-- start center select2 -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': almsRound.validation.center_id_hasError,
                'was-validated':
                  almsRound.validation.center_id_successMessage &&
                  !almsRound.validation.center_id_hasError,
              }"
            >
              <label for="country-id">
                Select Center
                <span class="text-danger">*</span>
              </label>
              <select2
                placeholder="Type To Search Center..."
                :url="center.model.fetchListUrl"
                :value="almsRound.model.center_id"
                @input="almsRound.model.almsRoundSelected($event)"
                :selected-option="almsRound.model.center"
                v-bind:class="{
                  'is-invalid': almsRound.validation.center_id_hasError,
                }"
              ></select2>

              <div class="invalid-feedback">
                {{ almsRound.validation.center_id_errorMessage }}
              </div>
              <div class="valid-feedback" style="display: block">
                {{ almsRound.validation.center_id_successMessage }}
              </div>
            </div>
            <!-- end center select2 -->

            <!-- start alms round name -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': almsRound.validation.name_hasError,
                'was-validated':
                  almsRound.validation.validation != null &&
                  !almsRound.validation.name_hasError,
              }"
            >
              <label for="about_item">
                Alms Round Name
                <span class="text-danger">*</span>
              </label>
              <input
                id="alms_round_name"
                type="text"
                class="form-control"
                placeholder="Alms Round Name"
                v-model="almsRound.model.name"
                v-bind:class="{ 'is-invalid': almsRound.validation.name_hasError }"
              />
              <div class="invalid-feedback">
                {{ almsRound.validation.name_errorMessage }}
              </div>
              <div class="valid-feedback">
                {{ almsRound.validation.name_successMessage }}
              </div>
            </div>
            <!-- end alms round name -->

            <button
              v-if="almsRound.model.isEdit"
              @click="almsRound.model.updateAlmsRound()"
              class="btn btn-success"
            >
              Update
            </button>
            <button
              v-if="almsRound.model.isEdit"
              @click="almsRound.model.goToList('alms-round-list')"
              class="btn btn-default"
            >
              Cancel
            </button>
            <button
              v-else
              @click="almsRound.model.saveAlmsRound()"
              class="btn btn-success"
            >
              Create
            </button>
          </div>
        </div>
      </div>
      <div
        class="tab-pane fade"
        id="alms-round-list"
        role="tabpanel"
        aria-labelledby="alms-round-list-tab"
      >
        <table
          class="table table-hover table-dark"
          cellpadding="0"
          cellspacing="0"
        >
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Center</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in almsRound.model.list.data" :key="item.id">
              <th scope="row">{{ index + 1 }}</th>
              <td style="max-width: 20px">{{ item.name }}</td>
              <td style="max-width: 20px">
                <i
                  aria-hidden="true"
                  v-if="item.center ? item.center.is_available == 1 : ''"
                  class="material-icons green"
                  >check_circle</i
                >
                <i
                  aria-hidden="true"
                  v-else-if="item.center ? item.center.is_available == 0 : ''"
                  class="material-icons red"
                  >cancel</i
                >
                {{ item.center ? item.center.name : "-" }}
              </td>
              <td style="max-width: 20px">
                <button
                  class="btn btn-outline-warning"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#edit-collapse-alms-round-${item.id}`"
                  aria-expanded="false"
                  aria-controls="editCollapseExample"
                >
                  Edit
                </button>
                <div :id="`edit-collapse-alms-round-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="almsRound.model.editRecord(index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#edit-collapse-alms-round-${item.id}`"
                    aria-expanded="false"
                    aria-controls="editCollapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
              <td style="max-width: 20px">
                <button
                  class="btn"
                  v-bind:class="{
                    'btn-outline-danger': item.deleted_at == null,
                    'btn-outline-success': item.deleted_at != null,
                  }"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#collapse-alms-round-${item.id}`"
                  aria-expanded="false"
                  aria-controls="collapseExample"
                >
                  {{ item.deleted_at == null ? "Delete" : "Restore" }}
                </button>
                <div :id="`collapse-alms-round-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="almsRound.model.deleteAlmsRound(item.id, index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#collapse-alms-round-${item.id}`"
                    aria-expanded="false"
                    aria-controls="collapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          :data="almsRound.model.list"
          align="center"
          v-on:pagination-change-page="getAlmsRoundResult"
        ></pagination>
      </div>
      <!-- end alms round -->

      <!-- start unit -->
      <div
        class="tab-pane fade row"
        id="unit-list-create"
        role="tabpanel"
        aria-labelledby="unit-create-tab"
      >
        <div class="col-md-6 card border border-success">
          <div class="card-body">
            
            <!-- start package unit -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': unit.validation.package_unit_hasError,
                'was-validated':
                  unit.validation.validation != null &&
                  !unit.validation.package_unit_hasError,
              }"
            >
              <label for="about_item">
                Package Unit
                <span class="text-danger">*</span>
              </label>
              <input
                id="package_unit"
                type="text"
                class="form-control"
                placeholder="Package Unit"
                v-model="unit.model.package_unit"
                v-bind:class="{ 'is-invalid': unit.validation.package_unit_hasError }"
              />
              <div class="invalid-feedback">
                {{ unit.validation.package_unit_errorMessage }}
              </div>
              <div class="valid-feedback">
                {{ unit.validation.package_unit_successMessage }}
              </div>
            </div>
            <!-- end package unit -->

            <!-- start package symbol -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': unit.validation.package_symbol_hasError,
                'was-validated':
                  unit.validation.validation != null &&
                  !unit.validation.package_symbol_hasError,
              }"
            >
              <label for="about_item">
                Package Symbol
                <span class="text-danger">*</span>
              </label>
              <input
                id="package_symbol"
                type="text"
                class="form-control"
                placeholder="Package Symbol"
                v-model="unit.model.package_symbol"
                v-bind:class="{ 'is-invalid': unit.validation.package_symbol_hasError }"
              />
              <div class="invalid-feedback">
                {{ unit.validation.package_symbol_errorMessage }}
              </div>
              <div class="valid-feedback">
                {{ unit.validation.package_symbol_successMessage }}
              </div>
            </div>
            <!-- end package symbol -->

            <!-- start loose symbol -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': unit.validation.loose_symbol_hasError,
                'was-validated':
                  unit.validation.validation != null &&
                  !unit.validation.loose_symbol_hasError,
              }"
            >
              <label for="about_item">
                Loose Symbol
                <span class="text-danger">*</span>
              </label>
              <input
                id="loose_symbol"
                type="text"
                class="form-control"
                placeholder="Loose Symbol"
                v-model="unit.model.loose_symbol"
                v-bind:class="{ 'is-invalid': unit.validation.loose_symbol_hasError }"
              />
              <div class="invalid-feedback">
                {{ unit.validation.loose_symbol_errorMessage }}
              </div>
              <div class="valid-feedback">
                {{ unit.validation.loose_symbol_successMessage }}
              </div>
            </div>
            <!-- end loose symbol -->

            <!-- start loose unit -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': unit.validation.loose_unit_hasError,
                'was-validated':
                  unit.validation.validation != null &&
                  !unit.validation.loose_unit_hasError,
              }"
            >
              <label for="about_item">
                Loose Unit
                <span class="text-danger">*</span>
              </label>
              <input
                id="loose_unit"
                type="text"
                class="form-control"
                placeholder="Loose Unit"
                v-model="unit.model.loose_unit"
                v-bind:class="{ 'is-invalid': unit.validation.loose_unit_hasError }"
              />
              <div class="invalid-feedback">
                {{ unit.validation.loose_unit_errorMessage }}
              </div>
              <div class="valid-feedback">
                {{ unit.validation.loose_unit_successMessage }}
              </div>
            </div>
            <!-- end loose unit -->

            <button
              v-if="unit.model.isEdit"
              @click="unit.model.updateUnit()"
              class="btn btn-success"
            >
              Update
            </button>
            <button
              v-if="unit.model.isEdit"
              @click="unit.model.goToList('unit-list')"
              class="btn btn-default"
            >
              Cancel
            </button>
            <button
              v-else
              @click="unit.model.saveUnit()"
              class="btn btn-success"
            >
              Create
            </button>
          </div>
        </div>
      </div>
      <div
        class="tab-pane fade"
        id="unit-list"
        role="tabpanel"
        aria-labelledby="unit-list-tab"
      >
        <table
          class="table table-hover table-dark"
          cellpadding="0"
          cellspacing="0"
        >
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Package Unit</th>
              <th scope="col">Loose Unit</th>
              <th scope="col">Package Symbol</th>
              <th scope="col">Loose Symbol</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in unit.model.list.data" :key="item.id">
              <th scope="row">{{ index + 1 }}</th>
              <td style="max-width: 20px">{{ item.package_unit }}</td>
              <td style="max-width: 20px">{{ item.loose_unit }}</td>
              <td style="max-width: 20px">{{ item.package_symbol }}</td>
              <td style="max-width: 20px">{{ item.loose_symbol }}</td>
              <td style="max-width: 20px">
                <button
                  class="btn btn-outline-warning"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#edit-collapse-unit-${item.id}`"
                  aria-expanded="false"
                  aria-controls="editCollapseExample"
                >
                  Edit
                </button>
                <div :id="`edit-collapse-unit-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="unit.model.editRecord(index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#edit-collapse-unit-${item.id}`"
                    aria-expanded="false"
                    aria-controls="editCollapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
              <td style="max-width: 20px">
                <button
                  class="btn"
                  v-bind:class="{
                    'btn-outline-danger': item.deleted_at == null,
                    'btn-outline-success': item.deleted_at != null,
                  }"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#collapse-unit-${item.id}`"
                  aria-expanded="false"
                  aria-controls="collapseExample"
                >
                  {{ item.deleted_at == null ? "Delete" : "Restore" }}
                </button>
                <div :id="`collapse-unit-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="unit.model.deleteUnit(item.id, index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#collapse-unit-${item.id}`"
                    aria-expanded="false"
                    aria-controls="collapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          :data="unit.model.list"
          align="center"
          v-on:pagination-change-page="getUnitResult"
        ></pagination>
      </div>
      <!-- end unit  -->

      <!-- start volunteer job -->
      <div
        class="tab-pane fade row"
        id="volunteer-job-list-create"
        role="tabpanel"
        aria-labelledby="volunteer-job-create-tab"
      >
        <div class="col-md-6 card border border-success">
          <div class="card-body">
            <!-- start volunteer job name -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': volunteerJob.validation.name_hasError,
                'was-validated':
                  volunteerJob.validation.validation != null &&
                  !volunteerJob.validation.name_hasError,
              }"
            >
              <label for="volunteer_job_name">
                Name
                <span class="text-danger">*</span>
              </label>
              <input
                id="volunteer_job_name"
                type="text"
                class="form-control"
                placeholder="Volunteer Job Name"
                v-model="volunteerJob.model.name"
                v-bind:class="{
                  'is-invalid': volunteerJob.validation.name_hasError,
                }"
              />
              <div class="invalid-feedback">
                {{ volunteerJob.validation.name_errorMessage }}
              </div>
              <div class="valid-feedback">
                {{ volunteerJob.validation.name_successMessage }}
              </div>
            </div>
            <!-- end volunteer job name -->

            <!-- start volunteer description name -->
            <div
              class="form-group"
              v-bind:class="{
                'has-error': volunteerJob.validation.description_hasError,
                'was-validated':
                  volunteerJob.validation.validation != null &&
                  !volunteerJob.validation.description_hasError,
              }"
            >
              <label for="volunteer_job_description">
                Description
                <span class="text-danger">*</span>
              </label>
              <textarea
                class="form-control"
                v-model="volunteerJob.model.description"
                v-bind:class="{
                  'is-invalid': volunteerJob.validation.description_hasError,
                }"
              ></textarea>
              <div class="invalid-feedback">
                {{ volunteerJob.validation.description_errorMessage }}
              </div>
              <div class="valid-feedback">
                {{ volunteerJob.validation.description_successMessage }}
              </div>
            </div>
            <!-- end volunteer description -->

            <button
              v-if="volunteerJob.model.isEdit"
              @click="volunteerJob.model.updateVolunteerJob()"
              class="btn btn-success"
            >
              Update
            </button>
            <button
              v-if="volunteerJob.model.isEdit"
              @click="volunteerJob.model.goToList('volunteer-job-list')"
              class="btn btn-default"
            >
              Cancel
            </button>
            <button
              v-else
              @click="volunteerJob.model.saveVolunteerJob()"
              class="btn btn-success"
            >
              Create
            </button>
          </div>
        </div>
      </div>
      <div
        class="tab-pane fade"
        id="volunteer-job-list"
        role="tabpanel"
        aria-labelledby="volunteer-job-list-tab"
      >
        <table
          class="table table-hover table-dark"
          cellpadding="0"
          cellspacing="0"
        >
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(item, index) in volunteerJob.model.list.data"
              :key="item.id"
            >
              <th scope="row">{{ index + 1 }}</th>
              <td style="max-width: 20px">{{ item.name }}</td>
              <td style="max-width: 20px">{{ item.description }}</td>
              <td style="max-width: 20px">
                <button
                  class="btn btn-outline-warning"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#edit-collapse-${item.id}`"
                  aria-expanded="false"
                  aria-controls="editCollapseExample"
                >
                  Edit
                </button>
                <div :id="`edit-collapse-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="volunteerJob.model.editRecord(index)"
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#edit-collapse-${item.id}`"
                    aria-expanded="false"
                    aria-controls="editCollapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
              <td style="max-width: 20px">
                <button
                  class="btn"
                  v-bind:class="{
                    'btn-outline-danger': item.deleted_at == null,
                    'btn-outline-success': item.deleted_at != null,
                  }"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#collapse-${item.id}`"
                  aria-expanded="false"
                  aria-controls="collapseExample"
                >
                  {{ item.deleted_at == null ? "Delete" : "Restore" }}
                </button>
                <div :id="`collapse-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="
                      volunteerJob.model.deleteVolunteerJob(item.id, index)
                    "
                  >
                    Yes
                  </button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#collapse-${item.id}`"
                    aria-expanded="false"
                    aria-controls="collapseExample"
                  >
                    No
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          :data="volunteerJob.model.list"
          align="center"
          v-on:pagination-change-page="getVolunteerJobResult"
        ></pagination>
      </div>
      <!-- end volunteer job -->
    </div>
  </div>
</template>

<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import cityValidation from "../validations/setting_component/city.js";
import cityModel from "../models/city.js";
import unitValidation from "../validations/setting_component/unit.js";
import unitModel from "../models/unit.js";
import centerValidation from "../validations/setting_component/center.js";
import centerModel from "../models/center.js";
import wardValidation from "../validations/setting_component/ward.js";
import wardModel from "../models/ward.js";
import countryValidation from "../validations/setting_component/country.js";
import countryModel from "../models/country.js";
import stateRegionValidation from "../validations/setting_component/state_region.js";
import stateRegionModel from "../models/state_region.js";
import officeValidation from "../validations/setting_component/office.js";
import officeModel from "../models/office.js";
import storeValidation from "../validations/setting_component/store.js";
import storeModel from "../models/store.js";
import boxValidation from "../validations/setting_component/box.js";
import boxModel from "../models/box.js";
import volunteerJobValidation from "../validations/setting_component/volunteer_job.js";
import volunteerJobModel from "../models/volunteer_job.js";
import itemTypeValidation from "../validations/setting_component/item_type.js";
import itemTypeModel from "../models/item_type.js";
import itemSubTypeValidation from "../validations/setting_component/item_sub_type.js";
import itemSubTypeModel from "../models/item_sub_type.js";
import almsRoundValidation from "../validations/setting_component/alms_round.js";
import almsRoundModel from "../models/alms_round.js";
import select2 from "./select2";

export default {
  data: () => ({
    fullPage: false,
    isLoading: false,
    city: {
      validation: new cityValidation(),
      model: new cityModel(),
    },
    country: {
      validation: new countryValidation(),
      model: new countryModel(),
    },
    stateRegion: {
      validation: new stateRegionValidation(),
      model: new stateRegionModel(),
    },
    office: {
      validation: new officeValidation(),
      model: new officeModel(),
    },
    store: {
      validation: new storeValidation(),
      model: new storeModel(),
    },
    box: {
      validation: new boxValidation(),
      model: new boxModel(),
    },
    center: {
      validation: new centerValidation(),
      model: new centerModel(),
    },
    ward: {
      validation: new wardValidation(),
      model: new wardModel(),
    },
    volunteerJob: {
      validation: new volunteerJobValidation(),
      model: new volunteerJobModel(),
    },
    itemType: {
      validation: new itemTypeValidation(),
      model: new itemTypeModel(),
    },
    itemSubType: {
      validation: new itemSubTypeValidation(),
      model: new itemSubTypeModel(),
    },
    almsRound: {
      validation: new almsRoundValidation(),
      model: new almsRoundModel(),
    },
    unit: {
      validation: new unitValidation(),
      model: new unitModel(),
    },
  }),
  computed: {
    isLoadingWatch() {
      return (
        this.city.model.isLoading ||
        this.country.model.isLoading ||
        this.stateRegion.model.isLoading ||
        this.office.model.isLoading ||
        this.store.model.isLoading ||
        this.box.model.isLoading ||
        this.center.model.isLoading ||
        this.ward.model.isLoading ||
        this.volunteerJob.model.isLoading ||
        this.itemType.model.isLoading ||
        this.itemSubType.model.isLoading ||
        this.almsRound.model.isLoading ||
        this.unit.model.isLoading
      );
    },
    isCreateSuccessWatch() {
      return (
        this.city.model.isCreateSuccess ||
        this.country.model.isCreateSuccess ||
        this.stateRegion.model.isCreateSuccess ||
        this.office.model.isCreateSuccess ||
        this.store.model.isCreateSuccess ||
        this.box.model.isCreateSuccess ||
        this.center.model.isCreateSuccess ||
        this.ward.model.isCreateSuccess ||
        this.volunteerJob.model.isCreateSuccess ||
        this.itemType.model.isCreateSuccess ||
        this.itemSubType.model.isCreateSuccess ||
        this.almsRound.model.isCreateSuccess ||
        this.unit.model.isCreateSuccess 
      );
    },
    isCreateFailWatch() {
      return (
        this.city.model.isCreateFail ||
        this.country.model.isCreateFail ||
        this.stateRegion.model.isCreateFail ||
        this.office.model.isCreateFail ||
        this.store.model.isCreateFail ||
        this.box.model.isCreateFail ||
        this.center.model.isCreateFail ||
        this.ward.model.isCreateFail ||
        this.volunteerJob.model.isCreateFail ||
        this.itemType.model.isCreateFail ||
        this.itemSubType.model.isCreateFail ||
        this.almsRound.model.isCreateFail ||
        this.unit.model.isCreateFail
      );
    },
    isUpdateSuccessWatch() {
      return (
        this.city.model.isUpdateSuccess ||
        this.country.model.isUpdateSuccess ||
        this.stateRegion.model.isUpdateSuccess ||
        this.office.model.isUpdateSuccess ||
        this.store.model.isUpdateSuccess ||
        this.box.model.isUpdateSuccess ||
        this.center.model.isUpdateSuccess ||
        this.ward.model.isUpdateSuccess ||
        this.volunteerJob.model.isUpdateSuccess ||
        this.itemType.model.isUpdateSuccess ||
        this.itemSubType.model.isUpdateSuccess ||
        this.almsRound.model.isUpdateSuccess ||
        this.unit.model.isUpdateSuccess
      );
    },
    isUpdateFailWatch() {
      return (
        this.city.model.isUpdateFail ||
        this.country.model.isUpdateFail ||
        this.stateRegion.model.isUpdateFail ||
        this.office.model.isUpdateFail ||
        this.store.model.isUpdateFail ||
        this.box.model.isUpdateFail ||
        this.center.model.isUpdateFail ||
        this.ward.model.isUpdateFail ||
        this.volunteerJob.model.isUpdateFail ||
        this.itemType.model.isUpdateFail ||
        this.itemSubType.model.isUpdateFail ||
        this.almsRound.model.isUpdateFail ||
        this.unit.model.isUpdateFail
      );
    },
    isDeleteSuccessWatch() {
      return (
        this.city.model.isDeleteSuccess ||
        this.country.model.isDeleteSuccess ||
        this.stateRegion.model.isDeleteSuccess ||
        this.office.model.isDeleteSuccess ||
        this.store.model.isDeleteSuccess ||
        this.box.model.isDeleteSuccess ||
        this.center.model.isDeleteSuccess ||
        this.ward.model.isDeleteSuccess ||
        this.volunteerJob.model.isDeleteSuccess ||
        this.itemType.model.isDeleteSuccess ||
        this.itemSubType.model.isDeleteSuccess ||
        this.almsRound.model.isDeleteSuccess ||
        this.unit.model.isDeleteSuccess
      );
    },
    isRestoreSuccessWatch() {
      return (
        this.city.model.isRestoreSuccess ||
        this.country.model.isRestoreSuccess ||
        this.stateRegion.model.isRestoreSuccess ||
        this.office.model.isRestoreSuccess ||
        this.store.model.isRestoreSuccess ||
        this.box.model.isRestoreSuccess ||
        this.center.model.isRestoreSuccess ||
        this.ward.model.isRestoreSuccess ||
        this.volunteerJob.model.isRestoreSuccess ||
        this.itemType.model.isRestoreSuccess ||
        this.itemSubType.model.isRestoreSuccess ||
        this.almsRound.model.isRestoreSuccess ||
        this.unit.model.isRestoreSuccess
      );
    },
    isDeleteFailWatch() {
      return (
        this.city.model.isDeleteFail ||
        this.country.model.isDeleteFail ||
        this.stateRegion.model.isDeleteFail ||
        this.office.model.isDeleteFail ||
        this.store.model.isDeleteFail ||
        this.box.model.isDeleteFail ||
        this.center.model.isDeleteFail ||
        this.ward.model.isDeleteFail ||
        this.volunteerJob.model.isDeleteFail ||
        this.itemType.model.isDeleteFail ||
        this.itemSubType.model.isDeleteFail ||
        this.almsRound.model.isDeleteFail ||
        this.unit.model.isDeleteFail
      );
    },
  },
  watch: {
    isLoadingWatch: function (newisLoading, oldisLoading) {
      this.isLoading = newisLoading;
    },
    isCreateSuccessWatch: function (newisCreateSuccess, oldisCreateSuccess) {
      if (newisCreateSuccess) {
        this.$toasted.show("Saving Success.", { icon: "save" });
        this.fetchListAndResetCondition();
      }
    },
    isCreateFailWatch: function (newisCreateFail, oldisCreateFail) {
      if (newisCreateFail) {
        this.$toasted.show("Saving Failed.", { icon: "save" });
      }
    },
    isUpdateSuccessWatch: function (newisUpdateSuccess, oldisUpdateSuccess) {
      if (newisUpdateSuccess) {
        this.$toasted.show("Upading Success.", { icon: "save" });
        this.fetchListAndResetCondition();
      }
    },
    isUpdateFailWatch: function (newisUpdateFail, oldisUpdateFail) {
      if (newisUpdateFail) {
        this.$toasted.show("Updaing Failed.", { icon: "save" });
      }
    },
    isDeleteSuccessWatch: function (newisDeleteSuccess, oldisDeleteSuccess) {
      if (newisDeleteSuccess) {
        this.$toasted.show("Delete Success.", { icon: "delete" });
        this.fetchListAndResetCondition();
      }
    },
    isRestoreSuccessWatch: function (newisRestoreSuccess, oldisRestoreSuccess) {
      if (newisRestoreSuccess) {
        this.$toasted.show("Restore Success.", { icon: "delete" });
        this.fetchListAndResetCondition();
      }
    },
    isDeleteFailWatch: function (newisDeleteFail, oldisDeleteFail) {
      if (newisDeleteFail) {
        this.$toasted.show("Delete Fail.", { icon: "delete" });
      }
    },
    "city.model.validation": function (newValidation, oldValidation) {
      this.city.validation = new cityValidation(newValidation);
    },
    "country.model.validation": function (newValidation, oldValidation) {
      this.country.validation = new countryValidation(newValidation);
    },
    "stateRegion.model.validation": function (newValidation, oldValidation) {
      this.stateRegion.validation = new stateRegionValidation(newValidation);
    },
    "office.model.validation": function (newValidation, oldValidation) {
      this.office.validation = new officeValidation(newValidation);
    },
    "store.model.validation": function (newValidation, oldValidation) {
      this.store.validation = new storeValidation(newValidation);
    },
    "box.model.validation": function (newValidation, oldValidation) {
      this.box.validation = new boxValidation(newValidation);
    },
    "center.model.validation": function (newValidation, oldValidation) {
      this.center.validation = new centerValidation(newValidation);
    },
    "ward.model.validation": function (newValidation, oldValidation) {
      this.ward.validation = new wardValidation(newValidation);
    },
    "volunteerJob.model.validation": function (newValidation, oldValidation) {
      this.volunteerJob.validation = new volunteerJobValidation(newValidation);
    },
    "itemType.model.validation": function (newValidation, oldValidation) {
      this.itemType.validation = new itemTypeValidation(newValidation);
    },
    "itemSubType.model.validation": function (newValidation, oldValidation) {
      this.itemSubType.validation = new itemSubTypeValidation(newValidation);
    },
    "almsRound.model.validation": function (newValidation, oldValidation) {
      this.almsRound.validation = new almsRoundValidation(newValidation);
    },
    "unit.model.validation": function (newValidation, oldValidation) {
      this.unit.validation = new unitValidation(newValidation);
    },
  },
  components: {
    Loading,
    select2,
  },
  methods: {
    getCityResult(page) {
      this.city.model.page = page;
      this.city.model.fetchList(page);
    },
    getCountryResult(page) {
      this.country.model.page = page;
      this.country.model.fetchList(page);
    },
    getStateRegionResult(page) {
      this.stateRegion.model.page = page;
      this.stateRegion.model.fetchList(page);
    },
    getOfficeResult(page) {
      this.office.model.page = page;
      this.office.model.fetchList(page);
    },
    getStoreResult(page) {
      this.store.model.page = page;
      this.store.model.fetchList(page);
    },
    getBoxResult(page) {
      this.box.model.page = page;
      this.box.model.fetchList(page);
    },
    getCenterResult(page) {
      this.center.model.page = page;
      this.center.model.fetchList(page);
    },
    getWardResult(page) {
      this.ward.model.page = page;
      this.ward.model.fetchList(page);
    },
    getVolunteerJobResult(page) {
      this.volunteerJob.model.page = page;
      this.volunteerJob.model.fetchList(page);
    },
    getItemTypeResult(page) {
      this.itemType.model.page = page;
      this.itemType.model.fetchList(page);
    },
    getItemSubTypeResult(page) {
      this.itemSubType.model.page = page;
      this.itemSubType.model.fetchList(page);
    },
    getAlmsRoundResult(page) {
      this.almsRound.model.page = page;
      this.almsRound.model.fetchList(page);
    },
    getUnitResult(page) {
      this.unit.model.page = page;
      this.unit.model.fetchList(page);
    },
    fetchListAndResetCondition() {
      this.stateRegion.model.fetchList(this.stateRegion.model.page);
      this.city.model.fetchList(this.city.model.page);
      this.office.model.fetchList(this.office.model.page);
      this.country.model.fetchList(this.country.model.page);
      this.store.model.fetchList(this.store.model.page);
      this.box.model.fetchList(this.box.model.page);
      this.center.model.fetchList(this.center.model.page);
      this.ward.model.fetchList(this.ward.model.page);
      this.volunteerJob.model.fetchList(this.volunteerJob.model.page);
      this.itemType.model.fetchList(this.itemType.model.page);
      this.itemSubType.model.fetchList(this.itemSubType.model.page);
      this.almsRound.model.fetchList(this.almsRound.model.page);
      this.unit.model.fetchList(this.unit.model.page);

      this.stateRegion.model.isCreateSuccess = false;
      this.city.model.isCreateSuccess = false;
      this.office.model.isCreateSuccess = false;
      this.country.model.isCreateSuccess = false;
      this.store.model.isCreateSuccess = false;
      this.box.model.isCreateSuccess = false;
      this.center.model.isCreateSuccess = false;
      this.ward.model.isCreateSuccess = false;
      this.volunteerJob.model.isCreateSuccess = false;
      this.itemType.model.isCreateSuccess = false;
      this.itemSubType.model.isCreateSuccess = false;
      this.almsRound.model.isCreateSuccess = false;
      this.unit.model.isCreateSuccess = false;

      this.stateRegion.model.isUpdateSuccess = false;
      this.city.model.isUpdateSuccess = false;
      this.office.model.isUpdateSuccess = false;
      this.country.model.isUpdateSuccess = false;
      this.store.model.isUpdateSuccess = false;
      this.box.model.isUpdateSuccess = false;
      this.center.model.isUpdateSuccess = false;
      this.ward.model.isUpdateSuccess = false;
      this.volunteerJob.model.isUpdateSuccess = false;
      this.itemType.model.isUpdateSuccess = false;
      this.itemSubType.model.isUpdateSuccess = false;
      this.almsRound.model.isUpdateSuccess = false;
      this.unit.model.isUpdateSuccess = false;

      this.stateRegion.model.isDeleteSuccess = false;
      this.city.model.isDeleteSuccess = false;
      this.office.model.isDeleteSuccess = false;
      this.country.model.isDeleteSuccess = false;
      this.store.model.isDeleteSuccess = false;
      this.box.model.isDeleteSuccess = false;
      this.center.model.isDeleteSuccess = false;
      this.ward.model.isDeleteSuccess = false;
      this.volunteerJob.model.isDeleteSuccess = false;
      this.itemType.model.isDeleteSuccess = false;
      this.itemSubType.model.isDeleteSuccess = false;
      this.almsRound.model.isDeleteSuccess = false;
      this.unit.model.isDeleteSuccess = false;

      this.stateRegion.model.isRestoreSuccess = false;
      this.city.model.isRestoreSuccess = false;
      this.office.model.isRestoreSuccess = false;
      this.country.model.isRestoreSuccess = false;
      this.store.model.isRestoreSuccess = false;
      this.box.model.isRestoreSuccess = false;
      this.center.model.isRestoreSuccess = false;
      this.ward.model.isRestoreSuccess = false;
      this.volunteerJob.model.isRestoreSuccess = false;
      this.itemType.model.isRestoreSuccess = false;
      this.itemSubType.model.isRestoreSuccess = false;
      this.almsRound.model.isRestoreSuccess = false;
      this.unit.model.isRestoreSuccess = false;

      this.$forceUpdate();
    },
  },
  mounted() {},
  created() {},
};
</script>

<style scoped>
.material-icons.red {
  color: red;
}
.material-icons.green {
  color: green;
}
.location-setting {
  color: green;
}
.store-setting {
  color: orange;
}
</style>