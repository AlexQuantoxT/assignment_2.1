# assignment_2.1
There are four apis, assignment_2.1/src/apis/ GroupApi.php,InternApi.php,MentorApi.php,CommentApi.php

On GET request if nothing is sent all apis will return the whole lits.

GroupApi:
On GET, GroupApi takes group_id parameter and will return everything about that group.
On POST, GroupApi takes group_name parameter and creates a new group.
On PATCH, GroupApi takes group_name, group_id parameters and updates that group.
On DELETE, GroupApi takes group_id parameter and deletes that group.

InternApi:
On GET, InternApi takes user_id parameter and will return everything about that intern.
On POST, InternApi takes user_name,user_lastname,role_id,group_id parameters and creates a new intern.
On PATCH, InternApi takes user_id, user_name, user_lastname,role_id, group_id parameters and updates that intern.
On DELETE, InternApi takes user_id parameter and deletes that intern.

MentorApi:
On GET, MentorApi takes user_id parameter and will return everything about that mentor.
On POST, MentorApi takes user_name, user_lastname, role_id, group_id parameters and creates new mentor.
On PATCH, MentorApi takes user_id, user_name, user_lastname, role_id, group_id parameters and updates that mentor.
On DELETE, MentorApi takes user_id parameter and deletes that mentor.

CommentApi:
On GET, CommentApi takes comment_id parameter and will return everything about that comment.
On POST, CommentApi takes comment, mentor_id, intern_id parameter and creates new comment.
On PATCH, CommentApi takes comment_text,comment_id, mentor_id, intern_id parameters and updates that comment.
On DELETE, CommentApi takes comment_id parameter and deletes that comment.
