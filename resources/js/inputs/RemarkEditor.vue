<template>
  <b-form-group
    id="pickedup_address"
    label-cols-sm="3"
    label-for="pickedup_address"
    :state="state"
    :valid-feedback="successMessage"
    :invalid-feedback="errorMessage"
  >
    <template v-slot:label>Remark</template>

    <editor-menu-bar :editor="editor" v-slot="{ commands, isActive }">
      <div>
        <button
          :class="isActive.heading({ level: 3 }) ? 'is-active btn btn-success' : 'btn btn-secondary'"
          @click="commands.heading({ level: 3 })"
        >H3</button>

        <button
          :class="isActive.bold() ? 'is-active btn btn-success' : 'btn btn-secondary'"
          @click="commands.bold"
        >
          <b-icon-type-bold></b-icon-type-bold>
        </button>

        <button
          :class="isActive.underline() ? 'is-active btn btn-success' : 'btn btn-secondary'"
          @click="commands.underline"
        >
          <b-icon-type-underline></b-icon-type-underline>
        </button>

        <button
          :class="isActive.paragraph() ? 'is-active btn btn-success' : 'btn btn-secondary'"
          @click="commands.paragraph"
        >P</button>

        <button
          :class="isActive.bullet_list() ? 'is-active btn btn-success' : 'btn btn-secondary'"
          @click="commands.bullet_list"
        >ul</button>

        <button
          :class="isActive.ordered_list() ? 'is-active btn btn-success' : 'btn btn-secondary'"
          @click="commands.ordered_list"
        >ol</button>

        <button class="btn btn-primary" @click="commands.undo">undo</button>

        <button class="btn btn-primary" @click="commands.redo">redo</button>
      </div>
    </editor-menu-bar>
    <editor-content class="alert alert-default" :editor="editor" />
  </b-form-group>
</template>

<script>
import { Editor, EditorContent, EditorMenuBar } from "tiptap";
import Limit from "../extensions/Limit";
import {
  HardBreak,
  Heading,
  HorizontalRule,
  OrderedList,
  BulletList,
  ListItem,
  TodoItem,
  TodoList,
  Bold,
  Link,
  Underline,
  History
} from "tiptap-extensions";
import RemarkInput from "../default_props_and_fns/remark_input.js";

export default {
  props: ["remark"],
  components: {
    EditorMenuBar,
    EditorContent
  },
  computed: {
    state() {
      if (this.remark.state === null) {
        return this.RemarkInput.state;
      } else {
        return this.remark.state;
      }
    },
    successMessage() {
      if (this.remark.state === null) {
        return this.RemarkInput.successMessage;
      } else {
        return this.remark.successMessage;
      }
    },
    errorMessage() {
      if (this.remark.state === null) {
        return this.RemarkInput.errorMessage;
      } else {
        return this.remark.errorMessage;
      }
    }
  },
  data() {
    return {
      RemarkInput: new RemarkInput(),
      editor: new Editor({
        content:
          "<h3>Remark Of the Item</h3><ul><li>Some Remark Here</li></ul>",
        onUpdate: ({ getHTML }) => {
          this.RemarkInput.validateRemark(getHTML());
          this.$emit("input", getHTML());
        },
        extensions: [
          new BulletList(),
          new HardBreak(),
          new Heading({ levels: [3] }),
          new HorizontalRule(),
          new ListItem(),
          new OrderedList(),
          new TodoItem(),
          new TodoList(),
          new Link(),
          new Bold(),
          new Underline(),
          new History(),
          new Limit({
            limit: 300
          })
        ]
      })
    };
  },
  beforeDestroy() {
    this.editor.destroy();
  }
};
</script>

<style >
.ProseMirror:focus {
  outline: none;
}
</style>