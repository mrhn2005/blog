## A simple blog
This is a simple blog written in laravel and has following features:

- Only authenticated users can see posts.
- Users with odd id cannot create posts.
- Users with even id can create posts.
- Only writer of a post can delete or update that post, unless the user is super admin.
- To define super admins add their emails comma separated in env file by key SUPER_ADMIN_EMAILS.
