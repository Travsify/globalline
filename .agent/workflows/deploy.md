---
description: How to deploy the GlobalLine application to production
---

// turbo-all
Whenever changes are ready for production, follow these steps to deploy:

1. Stage all changes:
   `git add .`

2. Commit changes with a descriptive message:
   `git commit -m "feat/fix: descriptive message"`

3. Push directly to the main branch to trigger the Render deployment:
   `git push origin main`

4. Verify the deployment progress on the Render dashboard or via the live URL:
   [https://globalline.onrender.com/](https://globalline.onrender.com/)
