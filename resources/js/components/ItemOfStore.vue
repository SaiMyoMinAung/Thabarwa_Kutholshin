<template>
  <div
    class="item border border-info rounded mb-1"
    v-bind:class="{
      'bg bg-success': source.active,
    }"
  >
    <div class="text-center">
      <i class="fas fa-star"></i>
      {{ source.item_type }}( {{ source.count }} )
      <ul style="list-style: none">
        <li
          v-for="(item, index) in source.item_sub_type"
          :key="index"
          class="rounded m-1 p-1"
          v-bind:class="{
            'bg bg-info': item.active,
          }"
        >
          {{ index + 1 }}. {{ item.name }}(
          <span class="badge badge-primary">{{ item.count }}</span> Sackets )
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    source: {
      type: Object,
      default() {
        return {};
      },
    },
  },
  computed: {
    active() {
      return this.source.active;
    },
  },
};
</script>

<style scoped>
.item {
  display: flex;
  flex-direction: column;
  border-bottom: 1px solid lightgrey;
  padding: 1em;
}
</style>
