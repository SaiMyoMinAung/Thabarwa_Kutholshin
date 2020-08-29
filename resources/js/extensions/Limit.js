import { Extension, Plugin } from "tiptap";

export default class Limit extends Extension {
  get name() {
    return "limit";
  }

  get defaultOptions() {
    return {
      limit: 200
    };
  }

  get plugins() {
    const { limit } = this.options;
    return [
      new Plugin({
        filterTransaction(tr, { doc }) {
          if (tr.steps.length) {
            const { size } = tr.steps[0].slice.content;
            if (doc.textContent.length + size >= limit) {
              if (tr.steps[0].slice.content.size > 0) {
                console.log(tr.steps);
                return false;
              }
            }
          }

          return true;
        }
      })
    ];
  }
}
