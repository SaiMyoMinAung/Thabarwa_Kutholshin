<template>
  <div>
    <b-form-group
      id="pickedup_address"
      label-cols-sm="3"
      label-for="pickedup_address"
      :state="RemarkInput.state"
      :valid-feedback="RemarkInput.succssMessage"
      :invalid-feedback="RemarkInput.errorMessage"
    >
      <template v-slot:label>Remark</template>
      <editor-menu-bar :editor="editor" v-slot="{ commands, isActive }">
        <div>
          <button
            :class="isActive.bold() ? 'is-active btn btn-success' : 'btn btn-secondary'"
            @click="commands.bold"
          >
            <b-icon-type-bold></b-icon-type-bold>
          </button>
          <button
            :class="isActive.italic() ? 'is-active btn btn-success' : 'btn btn-secondary'"
            @click="commands.italic"
          >
            <b-icon-type-italic></b-icon-type-italic>
          </button>

          <button
            :class="isActive.strike() ? 'is-active btn btn-success' : 'btn btn-secondary'"
            @click="commands.strike"
          >
            <b-icon-type-strikethrough></b-icon-type-strikethrough>
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
            :class="isActive.heading({ level: 1 }) ? 'is-active btn btn-success' : 'btn btn-secondary'"
            @click="commands.heading({ level: 1 })"
          >H1</button>

          <button
            :class="isActive.heading({ level: 2 }) ? 'is-active btn btn-success' : 'btn btn-secondary'"
            @click="commands.heading({ level: 2 })"
          >H2</button>

          <button
            :class="isActive.heading({ level: 3 }) ? 'is-active btn btn-success' : 'btn btn-secondary'"
            @click="commands.heading({ level: 3 })"
          >H3</button>

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
      <editor-content class="alert alert-success" :editor="editor" />
    </b-form-group>
  </div>
</template>

<script>
import { Editor, EditorContent, EditorMenuBar } from "tiptap";
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
  Italic,
  Link,
  Strike,
  Underline,
  History
} from "tiptap-extensions";
import RemarkInput from "../default_props_and_fns/remark_input.js";

export default {
  components: {
    EditorMenuBar,
    EditorContent
  },
  data() {
    return {
      RemarkInput: new RemarkInput(),
      editor: new Editor({
        content: "<h2>Remark Of The Item</h2><ul><li>Example Remark</li></ul>",
        onUpdate: ({ getHTML }) => {
          this.$emit("input", getHTML());
        },
        extensions: [
          new BulletList(),
          new HardBreak(),
          new Heading({ levels: [1, 2, 3] }),
          new HorizontalRule(),
          new ListItem(),
          new OrderedList(),
          new TodoItem(),
          new TodoList(),
          new Link(),
          new Bold(),
          new Italic(),
          new Strike(),
          new Underline(),
          new History()
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