# Site settings

`site-settings.json` is the versioned source for shared site contact settings.
After this theme is deployed, WordPress syncs a changed `contact_phone` value
to **Theme Settings → Footer → Direct Helpline** on the next request. The ACF
value then supplies the header WhatsApp links, the footer and product helpline,
and Contact modules. Contact module phone fields load the shared value while it
is configured.

The sync runs only when the JSON phone value changes. Editing the ACF setting in
WordPress remains effective until `contact_phone` changes in this file.
