FROM node:19
WORKDIR "/app"
COPY ./www-client/package.json ./
RUN npm install
COPY ./www-client .
CMD ["npm", "run", "dev"]
