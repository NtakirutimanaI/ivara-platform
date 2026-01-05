---
description: Set up backend microservice with Node.js, Express, TypeScript, Mongoose, MongoDB
---

1. Create backend microservice directory
```bash
mkdir backend-microservice
```

2. Initialize npm project
```bash
cd backend-microservice
npm init -y
```

3. Install production dependencies
```bash
npm install express mongoose cors dotenv
```

4. Install development dependencies
```bash
npm install -D typescript @types/express @types/node ts-node-dev
```

5. Initialize TypeScript configuration
```bash
npx tsc --init --rootDir src --outDir dist --esModuleInterop --resolveJsonModule --module commonjs --target es6
```

6. Create source folder and main server file
```bash
mkdir src
```
Create `src/index.ts` with Express server and MongoDB connection (see file creation step).

7. Create `.env` file with `MONGODB_URI` variable.

8. Add start scripts to `package.json`:
```json
"scripts": {
  "dev": "ts-node-dev src/index.ts",
  "build": "tsc",
  "start": "node dist/index.js"
}
```

9. Run development server
// turbo
```bash
npm run dev
```

**Workflow completed.**
