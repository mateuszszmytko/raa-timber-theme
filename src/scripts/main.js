import { Karrot } from "@karrot/core";
import { FormAjax, FormValidation, ScrollTo } from '@karrot/common';

import { Site } from "./site";

Karrot.attach('my-form', FormAjax, FormValidation);
Karrot.attach('link', ScrollTo);
Karrot.attach('site', Site);

const form = Karrot.get('form');

// eslint-disable-next-line no-console
console.log(form, 'hello world');


