export type Field = {
  id: string;
  name: string;
  description: string;
  image: string;
};

export type Program = {
  id: string;
  name: string;
  description: string;
  type: string;
  priorEducation: string;
  additionalInformation: string;
  tag: string;
};

export type Subject = {
  id: string;
  name: string;
  description: string;
};

export type ProgramItem = Pick<
  Program,
  "id" | "name" | "description" | "tag" | "type"
>;
